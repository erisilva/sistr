<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trlogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('tr_id'); 
            $table->string('changes');            
            $table->timestamps();

            //fk
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tr_id')->references('id')->on('trs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trlogs', function (Blueprint $table) {
            $table->dropForeign('trlogs_user_id_foreign');
            $table->dropForeign('trlogs_tr_id_foreign');
        });
        Schema::dropIfExists('trlogs');
    }
}
