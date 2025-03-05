<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiclecat extends Model
{
    /** @use HasFactory<\Database\Factories\VehiclecatFactory> */
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
