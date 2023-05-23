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
        if (!Schema::hasTable('avatars')) {
        Schema::create('avatars', function (Blueprint $table) {
            $table->string('Image')->primary();
            $table->unsignedBigInteger('MemberID');
            $table->foreign('MemberID')->references('MemberID')->on('members');
        });
    }
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avatars');
    }
};
