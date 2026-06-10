<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            if (!Schema::hasColumn('attachments', 'event_id')) {
                $table->foreignId('event_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('attachments', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('attachments', 'file_path')) {
                $table->string('file_path');
            }
            if (!Schema::hasColumn('attachments', 'file_name')) {
                $table->string('file_name');
            }
            if (!Schema::hasColumn('attachments', 'file_type')) {
                $table->string('file_type')->nullable();
            }
            if (!Schema::hasColumn('attachments', 'size')) {
                $table->unsignedInteger('size')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn(['event_id', 'user_id', 'file_path', 'file_name', 'mime_type', 'size']);
        });
    }
};
