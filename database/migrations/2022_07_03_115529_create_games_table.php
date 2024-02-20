<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id()->comment('Id of the game.');
            $table->string('name')->comment('Name of the game.');
            $table->string('slug')->unique()->comment('Slugify the name of the game.');
            $table->foreignId('folder_id')->constrained('folders')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('order')->comment('Order of this game.');
            $table->boolean('published')->comment('The game is published or not.');
            $table->timestamp('published_at')->nullable()->comment('The date on which the game was published.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
