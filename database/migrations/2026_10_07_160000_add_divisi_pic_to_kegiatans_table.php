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
        // Guard: only add if columns do not exist (for fresh DB)
        if (!Schema::hasColumn('kegiatans', 'divisi')) {
            Schema::table('kegiatans', function (Blueprint $table) {
                $table->string('divisi', 100)->nullable()->after('lokasi');
                $table->string('pic', 100)->nullable()->after('divisi');

                // Indexes for faster lookup and filtering
                $table->index('divisi');
                $table->index('tanggal');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['divisi', 'pic']);
            $table->dropIndex(['divisi']);
            $table->dropIndex(['tanggal']);
        });
    }
};
