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
        Schema::create('avatar', function (Blueprint $table) {
            $table->increments('ID_Img');
            $table->string('Name_Img');
            $table->unsignedInteger('member_id')->nullable();
            $table->foreign('member_id')->references('MemberID')->on('members')->onDelete('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('avatar');

    }
};
