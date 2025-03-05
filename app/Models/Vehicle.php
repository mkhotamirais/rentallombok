<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'slug',
        'license_plate',
        'rental_price',
        'color',
        'policy',
        'information',
        'banner',
        'vehiclecat_id',
        // 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function vehiclecat()
    {
        return $this->belongsTo(Vehiclecat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
