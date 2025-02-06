<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $table = 'boxes';

    

    protected $fillable = [
   
'sender_id',
'box_number',


    ];

    // Define relationship with customer
    public function sender() {
        return $this->belongsTo(Sender::class);
    }


    // Define relationship with items
    public function items()
    {
        return $this->hasMany(Item::class, );
    }
   
}