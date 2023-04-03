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
        Schema::create('Enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('Logradouro');
            $table->string('Cidade');
            $table->string('Bairro');
            $table->integer('Numero');
            $table->char('CEP',8);
            $table->string('UF',2);
            $table->float('Latitude')->nullable();
            $table->float('Longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Enderecos');
    }
};
