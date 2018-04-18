<?php namespace Dgkim\DigitalResourcesDb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDgkimDigitalresourcesdbCategoryResource extends Migration
{
    public function up()
    {
        Schema::create('dgkim_digitalresourcesdb_category_resource', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id')->unsigned();
            $table->integer('resource_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dgkim_digitalresourcesdb_category_resource');
    }
}
