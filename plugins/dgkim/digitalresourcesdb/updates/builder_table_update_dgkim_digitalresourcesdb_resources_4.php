<?php namespace Dgkim\DigitalResourcesDb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDgkimDigitalresourcesdbResources4 extends Migration
{
    public function up()
    {
        Schema::table('dgkim_digitalresourcesdb_resources', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('dgkim_digitalresourcesdb_resources', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
