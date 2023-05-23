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
        Schema::create('Role', function (Blueprint $table) {
            $table->increments('ID_VT');
            $table->string('Name_VT');
            $table->string('source');
            $table->String('Nhom_A')->nullable();
            $table->unsignedInteger('Nhom_B')->nullable();
            $table->unsignedInteger('totalMembers')->nullable();
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
         Schema::dropIfExists('Role');

    }
};
