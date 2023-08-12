<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add is_admin column to users table.
 * Add user fields
 *
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')
                ->default(false)
                ->after('password');

            $table->string('website')
                ->after('name');

            $table->boolean('active')
                ->default(true)
                ->after('website');

            $table->integer('capacity')
                ->default(100)
                ->after('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('website');
            $table->dropColumn('active');
            $table->dropColumn('capacity');
        });
    }
};