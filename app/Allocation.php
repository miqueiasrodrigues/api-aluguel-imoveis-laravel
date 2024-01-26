<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $fillable = [
        'user_id',
        'house_id',
        'allocation_date',
        'departure_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
