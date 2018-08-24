<?php namespace Dgkim\DigitalResourcesDb\Components;

use Auth;
use Input;
use Validator;
use Redirect;
use Flash;
use Session;
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
        $pagedata = Session::get('page.data');

        $this->page['pagedata'] = $pagedata;
		$this->page['resource'] = $resource;
	}
}
