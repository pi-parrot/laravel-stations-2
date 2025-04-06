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
        if (!Schema::hasTable('genres')) {
            Schema::create('genres', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique()->comment('ジャンル名');
                $table->timestamps();
            });
        }
        Schema::table('movies', function (Blueprint $table) {
            $table->foreignId('genre_id')
                ->after('id')
                ->constrained('genres')
                // ジャンル削除時にそのジャンルに紐づく映画があると
                // 整合性が取れなくなるので、同時に映画も削除されるようにする
                ->onDelete('cascade')
                ->comment('ジャンル ID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
        });
        Schema::dropIfExists('genres');
    }
};
