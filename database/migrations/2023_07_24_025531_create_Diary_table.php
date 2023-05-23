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
        Schema::create('dirty', function (Blueprint $table) {
            $table->increments('ID_NK');
            $table->string('Name_DN');

            $table->string('host');
            $table->string('operation');
            $table->unsignedInteger('member_id')->nullable();
            $table->foreign('member_id')->references('MemberID')->on('members')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('Impact_time')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('dirty');

    }
};
