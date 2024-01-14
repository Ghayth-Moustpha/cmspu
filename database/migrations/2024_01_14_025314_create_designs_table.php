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
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title") ; 
            $table->text("Abstract"); 
            $table->text("filepath"); 
            $table->unsignedBigInteger("requirement_id") ; 
            $table->foreign('requirement_id')->references('id')->on('requirements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
