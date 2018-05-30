<?php namespace Dgkim\DigitalResourcesDb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDgkimDigitalresourcesdbResources2 extends Migration
{
    public function up()
    {
        Schema::table('dgkim_digitalresourcesdb_resources', function($table)
        {
            $table->text('description')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('dgkim_digitalresourcesdb_resources', function($table)
        {
            $table->text('description')->nullable(false)->change();
        });
    }
}
