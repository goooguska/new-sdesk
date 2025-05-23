<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_id')->nullable()->change();

            $table->dropForeign(['assigned_id']);

            $table->foreign('assigned_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->dropForeign(['creator_id']);
            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['assigned_id']);
            $table->foreign('assigned_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->dropForeign(['creator_id']);
            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }
};
