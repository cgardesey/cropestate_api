<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create
        ('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('userid')->unique();
            $table->string('phonenumber')->unique();
            $table->string('email')->nullable();
            $table->boolean('email_verified')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('confirmation_token')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('othernames')->nullable();
            $table->string('profilepicurl')->nullable();
            $table->string('role');
            $table->boolean('active')->default(true);
            $table->boolean('connected')->default(false);
            $table->string('apphash')->nullable();
            $table->string('osversion')->nullable();
            $table->string('sdkversion')->nullable();
            $table->string('device')->nullable();
            $table->string('devicemodel')->nullable();
            $table->string('deviceproduct')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('androidid')->nullable();
            $table->string('versionrelease')->nullable();
            $table->string('deviceheight')->nullable();
            $table->string('devicewidth')->nullable();
            $table->timestamps();
        });
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
