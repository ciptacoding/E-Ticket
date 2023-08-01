<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    use HasFactory;
    protected $guaded = ['id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
