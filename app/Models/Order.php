<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'total_amount' => 'decimal:2',
        'delivery_status' => 'integer',
        'payment_status' => 'integer',
        'delivery_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_payment_amount' => 'decimal:2',
        'status' => 'integer',
    ];


    public function deliveryCompany()
    {
        return $this->belongsTo(\App\Models\DeliveryCompany::class);
    }

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
        return $this->belongsTo(\App\Models\Postcode::class);
    }
}
