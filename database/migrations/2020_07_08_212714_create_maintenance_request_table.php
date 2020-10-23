<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_request_table', function (Blueprint $table) {
            $table->increments('ID');
            $table->date('nyuko_bi');
            $table->date('nousya_yoteibi');
            $table->string('sei');
            $table->string('mei');
            $table->integer('tel');
            $table->string('mail');
            $table->string('car_name');
            $table->string('katasiki');
            $table->string('tourokubangou');
            $table->date('syakenmanryou_bi');
            $table->string('seibi_syurui');
            $table->string('seibi_naiyou');
            $table->string('sensya');
            $table->string('syanaiseisou');
            $table->string('tokki_zikou');
            $table->string('tokki_zikou_syousai');
            $table->string('identify_ID');
            $table->renameColumn('id', 'ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_request_table');
    }
}
