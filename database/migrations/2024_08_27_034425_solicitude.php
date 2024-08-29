<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tiposolicitudes_id');
            $table->foreign('tiposolicitudes_id')->references('id')->on('tiposolicitudes')->onDelete('cascade');
            $table->string('descripcion', 100)->nullable();


            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};