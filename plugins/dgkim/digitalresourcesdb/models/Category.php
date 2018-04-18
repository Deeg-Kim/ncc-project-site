<?php namespace Dgkim\DigitalResourcesDb\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dgkim_digitalresourcesdb_categories';
	
	public $belongsToMany = [
    	'resources' => ['Dgkim\DigitalResourcesDb\Models\Resource', 'table' => 'dgkim_digitalresourcesdb_category_resource']
    ];
}
