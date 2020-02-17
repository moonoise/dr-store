<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', ['member', 'admin'])->default('member');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        App\User::create([
            'name' => env('NAME_ROOT','root'),
            'email' => env('EMAIL_ROOT','test@ridmail.com'),
            'email_verified_at' => now(),
            'password' => Hash::make(env('PASS_ROOT','1234password')), // password
            'remember_token' => Str::random(10),
        ]);

        App\User::where('email',env('EMAIL_ROOT','test@test.com'))->update(['role' => env('ROLE', 'admin') ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
