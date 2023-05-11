<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = ['reservation_id', 'json_data', 'type', 'create_date'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
