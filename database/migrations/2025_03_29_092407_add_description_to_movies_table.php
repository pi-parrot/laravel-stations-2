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
        Schema::table('movies', function (Blueprint $table) {
            // $table->id();
            // $table->string('title')->comment('映画タイトル');
            // $table->string('image_url')->comment('画像 URL');
            $table->integer('published_year')->comment('公開年')->after('image_url');
            $table->boolean('is_showing')->default(false)->comment('上映中かどうか')->after('published_year');
            $table->text('description')->comment('概要')->after('is_showing');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('is_showing');
            $table->dropColumn('published_year');
        });
    }
};
