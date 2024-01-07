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
        Schema::create('need_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
        Schema::table('needs', function (Blueprint $table) {
            $table->unsignedBigInteger('need_status_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('need_status_id')
                ->references('id')
                ->on('need_statuses')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('needs', function (Blueprint $table) {
            $table->dropForeign(['need_status_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('need_status_id');
            $table->dropColumn('user_id');
        });
    }
};