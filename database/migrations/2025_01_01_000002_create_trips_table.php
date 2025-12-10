<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * AQUÍ ES DONDE VA EL "UP" (Crear la tabla)
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            
            $table->id(); 
            $table->string('title'); 
            $table->text('description'); 
            $table->date('travel_date'); 
        
            $table->decimal('price', 10, 2)->nullable(); 
            $table->enum('status', ['done', 'offer'])->default('done'); 
            $table->string('image_url');
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};