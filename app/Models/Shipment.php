<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    public $timestamps = false;
    // protected $guarded = []; 
    protected $table = 'shipments';
    protected $fillable = [
       
        'shipment_via',
        'actual_weight',
        'invoice_date',
        'dimension',
        'sender_id',

    ];

    public function sender()
    {
        return $this->belongsTo(Sender::class);
    }
}
