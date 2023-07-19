<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

}
