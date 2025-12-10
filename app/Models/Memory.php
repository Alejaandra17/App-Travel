<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Memory extends Model
{
    protected $table = 'memories';
    
    protected $fillable = ['note', 'trip_id'];

    // Un recuerdo pertenece a un viaje
    function trip(): BelongsTo {
        return $this->belongsTo('App\Models\Trip', 'trip_id');
    }
}