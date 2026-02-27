<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('trs', function (Blueprint $table) {
            $table->string('sei')->default('')
                ->nullable()
                ->after('publicacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trs', function (Blueprint $table) {
            $table->dropColumn('sei');
        });
    }
};
