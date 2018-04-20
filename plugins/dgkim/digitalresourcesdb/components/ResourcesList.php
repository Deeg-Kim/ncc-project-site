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
		$this->prepareVars(); 
	}
	
	function onFilter() 
	{ 
		$this->prepareVars(); 
	}
	
	function prepareVars() {
		function array_strpos($haystack, $needles)
		{
			foreach($needles as $needle)
				if(strpos($haystack, $needle) !== false) return true;
			return false;
		}
		
        $words = post('search');
		$words = explode(' ', $words);
		$words = array_map('strtolower', $words);
		$searchType = post('searchType');
		
		$resources = Resource::get();
		$resourceArray = [];
		
		foreach ($resources as $resource) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $resource->link);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
			$headers = curl_getinfo($ch);
			curl_close($ch);

			$status = $headers['http_code'];

			$attributes = $resource->attributes;

			if ($status == 200 || $status == 301 || $status == 302) {
				$attributes['broken'] = 0;
			} else {
				$attributes['broken'] = 1;
			}
			
			$attributes['categories'] = $resource->categories;
			
			if (empty($searchType)) {
				$resourceArray[] = $attributes;
			} elseif($words[0] == "") {
				$resourceArray[] = $attributes;
			} else {
				
				$added = false;
				if (in_array("title", $searchType) && $added == false) {
					$english = explode(' ', $attributes['name_english']);
					$english = array_map('strtolower', $english);
					
					if(!empty(array_intersect($words, explode(' ', $attributes['name_japanese']))) || !empty(array_intersect($words, $english))) {
						$resourceArray[] = $attributes;
						$added = true;
					}
				}
				
				if (in_array("keywords", $searchType) && $added == false) {
					$keywords = explode(',', $attributes['keywords']);
					$keywords = array_map('strtolower', $keywords);
					
					if(!empty(array_intersect($keywords, $words))) {
						$resourceArray[] = $attributes;
						$added = true;
					}
				}
				
				if (in_array("description", $searchType) && $added == false) {
					$description = strip_tags(strtolower($attributes['description']));
					$flag = array_strpos($description, $words);
					
					if ($flag) {
						$resourceArray[] = $attributes;
						$added = true;
					}
				}
			}
		}
		
		$this->page['resources'] = $resourceArray;
    }
}