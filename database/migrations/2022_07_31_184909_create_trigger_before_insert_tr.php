<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class CreateTriggerBeforeInsertTr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("

CREATE TRIGGER trs_before_insert
BEFORE INSERT
   ON trs FOR EACH ROW

BEGIN

    DECLARE esseano INT;
    
    DECLARE novonumero INT;

    SELECT YEAR(CURDATE()) INTO esseano;
    
    SELECT COALESCE(MAX(numero) + 1, 1) INTO novonumero FROM trs WHERE ano = esseano;
    
    SET NEW.ano = esseano;
    
    SET NEW.numero = novonumero;
    
END; 
            
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trs_before_insert;');
    }
}
