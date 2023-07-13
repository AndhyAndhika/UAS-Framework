<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transaction";
    protected $guarded = [];

    public function Inventory()
    {
        return $this->belongsTo(Inventory::class, 'id_inventory', 'id'); //One to one
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'id_user', 'id'); //One to one
    }
}
