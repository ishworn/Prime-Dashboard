@extends('admin.admin_master')
@section('admin')




<div class="page-content">
    <div class="container-fluid">


        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
        <style>
            @media print {
                body {
                    print-color-adjust: exact;
                    -webkit-print-color-adjust: exact;
                }

                .no-print {
                    display: none;
                }
            }
        </style>

        <div class="bg-white p-8 shadow-lg">
            <table id="invoice-table" class="w-full border-collapse border border-gray-300">
                <div id="invoice-content">
                    <thead>
                        <tr>
                            <th colspan="8" class="border border-gray-300 p-2 text-center bg-gray-50 font-bold text-lg">
                                INVOICE & PACKING LIST
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="3" class="border border-gray-300 p-2">
                                <div>COUNTRY OF ORIGIN: NEPAL</div>
                                <div>INVOICE DATE: {{$sender->created_at }}</div>
                                <div>INVOICE NO: {{ $invoice->number ?? 'INV-001' }}</div>
                                <div>TOTAL Box: {{ $invoice->total_boxes ?? '2' }}</div>

                            </td>

                            <td colspan="4" class="border border-gray-300 p-2">
                                @foreach($shipments as $shipment)


                                <div>SHIPMENT VIA: {{ $shipment->shipment_via  }}</div>
                                <div>ACTUAL WEIGHT: {{ $shipment->actual_weight }}</div>

                                <div>Dimension: {{ $shipment->dimension }}</div>
                                @endforeach
                            </td>
                        </tr>
                        <!-- Shipper Details -->
                        <tr>
                            <td colspan="3" class="border border-gray-300 p-2">
                                <div class="font-bold">SHIPPER</div>
                                <div>OM X. GLOBAL PVT. LTD. (TRADE NAME- PRIME GORKHA SER</div>
                                <div>Sender Name : {{ $sender->senderName }}
                                </div>
                                <div>PAN NO: 615794828</div>
                                <div>Aloknagor-310 Kathmandu</div>
                                <div>Email: werep@primegorkha.com</div>
                                <div>Phone: +977 9708072372</div>
                            </td>
                            <td colspan="4" class="border border-gray-300 p-2">
                                <div class="font-bold">CONSIGNEE</div>
                                @foreach($receivers as $receiver)
                                <div>Name: {{ $receiver->receiverName }}</div> <!-- Adjust column name if needed -->
                                <div>Phone: {{ $receiver->receiverPhone  }}</div>
                                <div>Email: {{ $receiver->receiverEmail  }}</div>
                                <div>Complete Address: {{ $receiver->receiverAddress  }}</div>
                                @endforeach

                            </td>
                        </tr>
                    </tbody>
                </div>
            </table>
        </div>
    </div>


 


</div>
</div>


<script>
        window.onload = function() {
            window.print();  // Automatically trigger the print dialog when the page loads
        };
    </script>


@endsection