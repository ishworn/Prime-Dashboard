<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];  
    
    protected $table = 'customerss';

    protected $fillable = [
        'shipment_via', 
        'actual_weight', 
        'invoice_date', 
        'dimension',
        'sender_name', 
        'sender_address', 
        'sender_email', 
        'sender_phone',
        'receiver_name', 
        'receiver_phone', 
        'receiver_email', 
        'receiver_address',
    ];

}
