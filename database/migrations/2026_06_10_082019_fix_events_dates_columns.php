<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // 1. Переименовываем start_date в start_time
            $table->renameColumn('start_date', 'start_time');

            // 2. Добавляем end_time
            $table->dateTime('end_time')->nullable()->after('start_time');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('start_time', 'start_date');
            $table->dropColumn('end_time');
        });
    }
};
