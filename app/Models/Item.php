<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'box_id',
        'sender_id',
        'item',
        'hs_code',
        'quantity',
        'unit_rate',
        'amount',
    ];

    // Define relationship to Box model (assuming you have Box model)
    public function box()
    {
        return $this->belongsTo(Box::class,);
    }
}
