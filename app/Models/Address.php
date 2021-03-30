<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
    ];

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function postcode()
    {
        return $this->belongsTo(\App\Models\PostCode::class);
    }

}