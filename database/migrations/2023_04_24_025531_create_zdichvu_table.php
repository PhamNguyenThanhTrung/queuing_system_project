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
        Schema::create('service', function (Blueprint $table) {
            $table->increments('ID_Dv');
            $table->string('code_Dv');
            $table->string('Name_Dv');
            $table->string('Describe_Dv');
            $table->string('Rules_of_grant');
            $table->string('Tinhtrang');
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
         Schema::dropIfExists('service');
    }
};
