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
        Schema::create('thietbi', function (Blueprint $table) {
            $table->increments('ID_Tb');
            $table->string('code_Tb');
            $table->string('Name_Tb');
            $table->string('Diachi');
            $table->string('dichvu_Sd');
            $table->string('Loai_Tb');
            $table->string('UserDN')->nullable();
            $table->string('password');
            $table->string('Tinhtrang');
            $table->string('TT_ketnoi');
            $table->unsignedInteger('member_id');
            $table->foreign('member_id')->references('MemberID')->on('members')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('thietbi');
    }
};
