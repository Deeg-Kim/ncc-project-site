<?php namespace Dgkim\DigitalResourcesDb\Models;

use Model;
use Backend\Models\User;

/**
 * Model
 */
class Blscan extends Model
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
    public $table = 'dgkim_digitalresourcesdb_blscan';

	public $hasMany = [
        'brokenlinks' => 'Dgkim\DigitalResourcesDb\Models\Brokenlink'
    ];
	
	public function getScannedbyAttribute() {
		$user = User::find($this->scanned_by_id);
		
		return $user->first_name . ' ' . $user->last_name;
	}
	
	public function getNumberlinksAttribute() {
		return $this->brokenlinks->count();
	}
}
