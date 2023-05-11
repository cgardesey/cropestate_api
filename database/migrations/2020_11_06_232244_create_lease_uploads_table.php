<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaseUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('leaseuploadid')->unique();
            $table->integer('leasecode')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('url')->nullable();

//            $table->foreign('leasecode')->references('CODE')->on('lease_tb');

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
        Schema::dropIfExists('lease_uploads');
    }
}
