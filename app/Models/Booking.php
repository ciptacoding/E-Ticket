<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UUID;

class Booking extends Model
{
    use HasFactory;
    use UUID;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deleteBlacklist($query){
        $query->where('status_entrance', 'Blacklist')->delete();
    }
}
