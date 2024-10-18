<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cotizacione_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizacione_id')->constrained('cotizaciones')->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->bigInteger('precio_unitario');
            $table->bigInteger('precio_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacione_detalles');
    }
};
