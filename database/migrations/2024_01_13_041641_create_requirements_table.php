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
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description');
            $table->string('Type'); 
            $table->integer('priority'); 
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('need_id');
            
            $table->integer("status") ; 
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
            $table->foreign('need_id')->references('id')->on('needs')->onDelete('cascade');

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
