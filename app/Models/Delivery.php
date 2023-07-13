<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = "delivery";
    protected $guarded = [];

    public function Transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi', 'id'); //One to one
    }
}
