<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('requests', function (Blueprint $table) {
          $table->increments('ID');
          $table->integer('UID');
          $table->integer('visible');
          $table->date('storage_date')->nullable($value = true);
          $table->date('retrieval_date')->nullable($value = true);
          $table->string('last_name', 50)->nullable($value = true);
          $table->string('first_name', 50)->nullable($value = true);
          $table->string('tel', 20)->nullable($value = true);
          $table->string('mailaddress', 50)->nullable($value = true);
          $table->string('car_name', 20)->nullable($value = true);
          $table->string('model', 20)->nullable($value = true);
          $table->string('license', 20)->nullable($value = true);
          $table->date('inspection_date')->nullable($value = true);
          $table->string('maintenance_type', 200)->nullable($value = true);
          $table->string('maintenance_detail', 500)->nullable($value = true);
          $table->string('wash', 10)->nullable($value = true);
          $table->string('clean', 10)->nullable($value = true);
          $table->string('notices', 200)->nullable($value = true);
          $table->string('notices_detail', 500)->nullable($value = true);
          $table->dateTime('updated')->useCurrent()->useCurrentOnUpdate();
          $table->dateTime('modified')->useCurrent();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
