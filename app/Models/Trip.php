<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'travel_date',
        'destination_id',
        'price',
        'status',
        'image_url'
    ];

    // Un viaje pertenece a un destino
    public function destination() {
        return $this->belongsTo(Destination::class);
    }

    //Un viaje tiene muchos recuerdos
    public function memories() {
        return $this->hasMany(Memory::class);
    }
}