<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('material_informatiques', function (Blueprint $table) {
            $table->string('Num_Inv')->primary();
            $table->string('type');
            $table->string('marque');
            $table->date('dateDacquisition');
            $table->date('EF');
            $table->string('etat');
            $table->string('code_Gresa');
            $table->foreign('code_Gresa')->references('code_Gresa')->on('etablissements')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_informatiques');
    }
};
