<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'phone', 'place', 'date', 'type', 'create_date'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
