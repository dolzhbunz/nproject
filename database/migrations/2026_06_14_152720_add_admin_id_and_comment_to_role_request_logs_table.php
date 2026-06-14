<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('role_request_logs', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->after('role_request_id');
            $table->text('comment')->nullable()->after('processed_by');
        });
    }

    public function down()
    {
        Schema::table('role_request_logs', function (Blueprint $table) {
            $table->dropColumn(['admin_id', 'comment']);
        });
    }
};
