<?php namespace Dgkim\DigitalResourcesDb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDgkimDigitalresourcesdbResources extends Migration
{
    public function up()
    {
        Schema::table('dgkim_digitalresourcesdb_resources', function($table)
        {
            $table->string('name_romanization', 255);
            $table->text('description_japanese');
            $table->string('name_english', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('dgkim_digitalresourcesdb_resources', function($table)
        {
            $table->dropColumn('name_romanization');
            $table->dropColumn('description_japanese');
            $table->string('name_english', 255)->nullable(false)->change();
        });
    }
}
