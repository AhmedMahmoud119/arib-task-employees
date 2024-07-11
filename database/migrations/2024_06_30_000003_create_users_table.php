<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->float('salary')->default(0);
            $table->string('image')->nullable();

            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('department_id');

            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
    }
}
