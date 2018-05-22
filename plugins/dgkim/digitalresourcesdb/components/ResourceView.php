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
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $resource->link);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$headers = curl_getinfo($ch);
		curl_close($ch);

		$status = $headers['http_code'];

		if ($status == 200 || $status == 301 || $status == 302) {
			$broken = 0;
		} else {
			$broken = 1;
		}
		
		$this->page['broken'] = $broken;
	}
}