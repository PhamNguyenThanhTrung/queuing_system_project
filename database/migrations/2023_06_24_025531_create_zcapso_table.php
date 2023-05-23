<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public $timestamps = false;

    public function up(): void
    {
        Schema::create('grant', function (Blueprint $table) {
            $table->increments('STT');
            $table->string('MemberName');
            $table->string('Name_Dv');
            $table->string('source');
            $table->unsignedInteger('member_id');
            $table->foreign('member_id')->references('MemberID')->on('members')->onDelete('cascade');
            $table->unsignedInteger('ID_Tb');
            $table->string('TinhTrang');
            $table->foreign('ID_Tb')->references('ID_Tb')->on('thietbi')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('expired_at')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('grant');

    }
};
