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
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type')->unique()->comment('Type of the static page.');
            $table->string('seo_title')->comment('Seo title of the static page.');
            $table->string('seo_description')->comment('Seo description of the static page.');
            $table->string('title')->comment('Title of the static page.');
            $table->integer('order')->comment('Order of the static page.');
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
        Schema::dropIfExists('static_pages');
    }
};