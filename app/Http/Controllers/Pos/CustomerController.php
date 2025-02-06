<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use Illuminate\Support\Carbon;
use Image;

use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Box;
use App\Models\Shipment;
use App\Models\Item;

use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;



class CustomerController extends Controller
{
    public function CustomerAll()
    {

        $senders = Sender::select('id', 'invoiceId',  'senderName', 'senderPhone', 'senderEmail', 'senderAddress',)->get();
        return view('backend.customer.customer_all', compact('senders'));
    } // End Method



    public function CustomerShow($id)
    {
        $sender = Sender::with(['boxes.items'])->findOrFail($id);
        // dd($sender->toArray()); 

        $receivers = Receiver::where('sender_id', $id)->get();

        $shipments = Shipment::where('sender_id', $id)->get();
        $totalQuantity = 0;

        foreach ($sender->boxes as $box) {
            $totalQuantity += $box->items->sum('quantity');
        }



// Assuming $sender is the sender object
$grandTotal = 0;

foreach ($sender->boxes as $box) {
    $grandTotal += $box->items->sum('amount');
}

// $grandTotalInWords = NumberToWords::convert($grandTotal);



        return view('backend.customer.customer_preview', compact('sender', 'receivers', 'shipments', 'totalQuantity' ,'grandTotal',));
    }

    public function CustomerAdd()
    {
        return view('backend.customer.customer_add');
    }    // End Method





    public function CustomerEdit($id)
    {

        $sender = Sender::findOrFail($id);
        return view('backend.customer.customer_edit', compact('sender'));
    } // End Method


    public function CustomerUpdate(Request $request)
    {

        $customer_id = $request->id;
        if ($request->file('customer_image')) {

            $image = $request->file('customer_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 343434.png
            Image::make($image)->resize(200, 200)->save('upload/customer/' . $name_gen);
            $save_url = 'upload/customer/' . $name_gen;

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'customer_image' => $save_url,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Customer Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);
        } else {

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Customer Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);
        } // end else

    } // End Method


    public function CustomerDelete($id)
    {

        $customers = Sender::findOrFail($id);


        Sender::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
   
  

   
  
   
   
  
  
   


    public function CustomerStore(Request $request)
    {
        $validated = $request->validate([

            'boxes' => 'required|array', // Expecting an array of boxes
        ]);


        try {




            // Step 1: Split the form data for sender, receiver, and shipment
            $senderData = [
                'senderName' => $request->senderName,
                'senderPhone' => $request->senderPhone,
                'senderEmail' => $request->senderEmail,
                'senderAddress' => $request->senderAddress,
            ];

            $receiverData = [
                'receiverName' => $request->receiverName,
                'receiverPhone' => $request->receiverPhone,
                'receiverEmail' => $request->receiverEmail,
                'receiverAddress' => $request->receiverAddress,
                'receiverPostalcode' => $request->receiverPostalcode, // Accessing receiver postal code
                'receiverCountry' => $request->receiverCountry,
            ];

            $shipmentData = [
                'shipment_via' => $request->shipment_via,
                'actual_weight' => $request->actual_weight,
                'invoice_date' => $request->invoice_date,
                'dimension' => $request->dimension,
            ];




            // Step 2: Insert sender data into the 'senders' table
            $sender = Sender::create($senderData);

            // Retrieve the sender_id
            $sender_id = $sender->id;

            // Step 3: Insert into 'receiver' and 'shipment' tables using sender_id
            $receiverData['sender_id'] = $sender_id;
            // dd($receiverData);
            Receiver::create($receiverData);


            $shipmentData['sender_id'] = $sender_id;
            Shipment::create($shipmentData);




            try {

                foreach ($validated['boxes'] as $index => $boxData) {
                    // Create Box and assign the sender_id to the box
                    $box = Box::create([
                        'sender_id' => $sender->id, // Using sender_id as the foreign key
                        'box_number' => 'Box' . ($index + 1), // Box number (e.g., Box 1, Box 2)
                    ]);

                    // Save items for the current box
                    foreach ($boxData['items'] as $itemData) {
                        Item::create([
                            'box_id' => $box->id,  // Foreign key to Box table
                            'sender_id' => $box->sender_id,
                            'item' => $itemData['item'],
                            'hs_code' => $itemData['hs_code'],
                            'quantity' => $itemData['quantity'],
                            'unit_rate' => $itemData['unit_rate'],
                            'amount' => $itemData['amount'],
                        ]);
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }










            // Redirect or return a success message
            return redirect()->route('customer.all')->with('success', 'Data saved successfully.');
        } catch (\Exception $e) {
            // Handle errors, if any
            return redirect()->route('customer.all')->with('error', 'An error occurred while saving the data.');
        }
    }

    // Add the exportToExcel method here
    public function exportToExcel($id)
    {
        // Fetch data (same as CustomerShow)
        $sender = Sender::with(['boxes.items'])->findOrFail($id);
        $receivers = Receiver::where('sender_id', $id)->get();
        $shipments = Shipment::where('sender_id', $id)->get();


        // Prepare data for export
        $data = [
            'sender' => $sender,
            'receivers' => $receivers,
            'shipments' => $shipments,
        ];

      
        return Excel::download(new ExcelExport($sender, $shipments, $receivers, ), 'invoice.xlsx');
    }



    public function printInvoice($id)
{
    $sender = Sender::with(['boxes.items'])->findOrFail($id);
    $receivers = Receiver::where('sender_id', $id)->get();
    $shipments = Shipment::where('sender_id', $id)->get();

    // Pass the data to the print view
    return view('backend.customer.print', compact( 'sender', 'shipments', 'receivers'));
}

}
