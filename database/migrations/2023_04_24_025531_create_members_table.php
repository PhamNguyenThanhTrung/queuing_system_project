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
    public function up()
    {
        if (!Schema::hasTable('members')) {
            Schema::create('members', function (Blueprint $table) {
                $table->increments('MemberID');
                $table->string('MemberName');
                $table->string('UserDN')->unique();
                $table->string('password');
                $table->string('Tel')->unique();
                $table->string('Email')->unique();
                $table->string('Nhom_A')->default('');
                $table->string('Vaitro')->default('');
                $table->string('Tinhtrang');
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */

    public function down()
{
    Schema::dropIfExists('members');
}

};
