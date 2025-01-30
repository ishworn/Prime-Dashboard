<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    protected $table = 'receivers'; // Specifies the table name

    protected $fillable = [

        'sender_id',
        'receiverName',
        'receiverPhone',
        'receiverEmail',     // Fixed extra space before this
        'receiverPostalcode',
        'receiverCountry',
        'receiverAddress',   // Fixed extra spaces before this
    ];

    // Define the relationship with the Sender model
    public function sender() {
        return $this->belongsTo(Sender::class);
    }
}
