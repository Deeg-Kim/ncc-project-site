<?php namespace Dgkim\DigitalResourcesDb\Components;

use Auth;
use Input;
use Validator;
use Redirect;
use Flash;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Dgkim\DigitalResourcesDb\Models\Resource;

class ResourcesList extends \Cms\Classes\ComponentBase
{	

    /**
     * Validation rules
     */
    public $rules = [];
	
    public function componentDetails()
    {
        return [
            'name' => 'Resources List',
            'description' => 'Load list of all resources'
        ];
    }
	
	public function onRun()
	{
		$resources = Resource::get();
		
		$this->page['resources'] = $resources;
	}
}