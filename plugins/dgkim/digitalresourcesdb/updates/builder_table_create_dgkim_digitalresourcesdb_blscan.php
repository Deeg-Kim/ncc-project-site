<?php namespace Dgkim\DigitalResourcesDb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDgkimDigitalresourcesdbBlscan extends Migration
{
    public function up()
    {
        Schema::create('dgkim_digitalresourcesdb_blscan', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('scan_start');
            $table->dateTime('scan_stop');
            $table->integer('scanned_by_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dgkim_digitalresourcesdb_blscan');
    }
}
