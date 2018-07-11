<?php namespace Dgkim\DigitalResourcesDb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDgkimDigitalresourcesdbBrokenlinks extends Migration
{
    public function up()
    {
        Schema::create('dgkim_digitalresourcesdb_brokenlinks', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('blscan_id');
            $table->integer('resource_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dgkim_digitalresourcesdb_brokenlinks');
    }
}
