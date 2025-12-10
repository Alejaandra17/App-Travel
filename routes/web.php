<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;

Route::controller(TripController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    
    Route::get('/recuerdos', 'memories')->name('trips.memories');
    Route::get('/ofertas', 'offers')->name('trips.offers');

    Route::get('/viaje/crear', 'create')->name('trips.create'); 
    Route::post('/viaje', 'store')->name('trips.store'); 

    Route::get('/viaje/{id}', 'show')->name('trip.show');

    Route::get('/viaje/{id}/editar', 'edit')->name('trip.edit');
    Route::put('/viaje/{id}', 'update')->name('trip.update');

    Route::delete('/viaje/{id}', 'destroy')->name('trip.destroy');

    Route::post('/viaje/{id}/recuerdo', 'storeMemory')->name('memory.store');
    Route::post('/viaje/{id}/comprar', 'buy')->name('trip.buy');

    Route::get('/imagen-privada/{filename}', 'getPrivateImage')->name('image.private');
});