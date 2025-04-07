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
        Schema::table('users', function (Blueprint $table) {
            $table->after('profile_photo_path', function (Blueprint $table){
                $table->string('google_id')->nullable();
                $table->string('google_token')->nullable();
                $table->string('google_refresh_token')->nullable();
                $table->string('google_avatar')->nullable();
                $table->string('facebook_id')->nullable();
                $table->string('facebook_token')->nullable();
                $table->string('facebook_refresh_token')->nullable();
                $table->string('facebook_avatar')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
