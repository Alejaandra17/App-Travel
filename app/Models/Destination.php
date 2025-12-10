<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $table = 'destinations';
    
    protected $fillable = ['name', 'image_url'];

   // Un destino puede tener muchos viajes
    function trips(): HasMany {
        return $this->hasMany('App\Models\Trip', 'destination_id');
    }
}