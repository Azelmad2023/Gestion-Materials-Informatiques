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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->string('code_Gresa')->primary();
            $table->string('nomEtabllissemnt_AR');
            $table->string('nomEtabllissemnt_FR');
            $table->string('email')->unique();
            $table->string('cycle');
            $table->string('password');
            $table->string('code_Commune');
            $table->foreign('code_Commune')->references('code_Commune')->on('communes')->onUpdate('cascade')->onDelete('cascade');
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
