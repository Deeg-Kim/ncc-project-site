<?php namespace Dgkim\DigitalResourcesDb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDgkimDigitalresourcesdbCategories extends Migration
{
    public function up()
    {
        Schema::create('dgkim_digitalresourcesdb_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name_english', 255);
            $table->string('name_japanese', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dgkim_digitalresourcesdb_categories');
    }
}
