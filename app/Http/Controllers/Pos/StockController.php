<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use DB;
use Illuminate\Support\Carbon;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

class StockController extends Controller
{
   public function StockReport(){
       //$allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
       $allData = DB::select('SELECT c.category_id,c.product_id,s.NAME as suppliername, p.NAME as productname,p.quantity,c.buying_qty FROM suppliers s LEFT JOIN products p ON p.supplier_id=s.id left JOIN purchases c ON c.product_id=p.id');
       //$allData = json_decode($allData,true);
       return view('backend.stock.stock_report', compact('allData'));
   } // End Method
    public function StockReportPdf(){
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('backend.pdf.stock_report_pdf', compact('allData'));
    }// End Method
    public function StockSupplierWise(){
        $suppliers = Supplier::all();
        $category = Category::all();
        return view('backend.stock.supplier_product_wise_report', compact('suppliers', 'category'));
    }// End Method
    public function SupplierWisePdf(Request $request){
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->where('supplier_id', $request->supplier_id)->get();
        return view('backend.pdf.supplier_wise_report_pdf', compact('allData'));

    }// End Method
    public function ProductWisePdf(Request $request){
       $product = Product::where('category_id', $request->category_id)->where('id', $request->product_id)->first();
       return view('backend.pdf.product_wise_report_pdf', compact('product'));
    }
}
