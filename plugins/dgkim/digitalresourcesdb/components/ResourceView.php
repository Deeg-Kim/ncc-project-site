<?php namespace Dgkim\DigitalResourcesDb\Components;

use Auth;
use Input;
use Validator;
use Redirect;
use Flash;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Dgkim\DigitalResourcesDb\Models\Resource;

class ResourceView extends \Cms\Classes\ComponentBase
{	

    /**
     * Validation rules
     */
    public $rules = [];
	
    public function componentDetails()
    {
        return [
            'name' => 'Resources View',
            'description' => 'View resource from ID'
        ];
    }
	
	public function onRun()
	{
		$resource = Resource::where('id', $this->param('id'))->first();
		
		$this->page['resource'] = $resource;
	}
}