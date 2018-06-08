<?php namespace Dgkim\DigitalResourcesDb\Components;

use Auth;
use Input;
use Validator;
use Redirect;
use Flash;
use Response;
use Cookie;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Dgkim\DigitalResourcesDb\Models\Category;
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
		
		$categories = Category::get();
		
        $words = post('search');
		$words = explode(' ', $words);
		$words = array_map('strtolower', $words);
		$searchType = post('searchType');
		$categoryFilter = post('categoryFilter');
		$countSet = false;
		$minutes = 60;
		
		$response = Response::make('searchFields');
		$wordCookie = Cookie::make('searchWords', serialize($words), $minutes);
		$response->withCookie($wordCookie);
		
		$alpha = get('page');
		
		if ($alpha == null) {
			$alpha = 'A';
		}
		
		if (empty($categoryFilter)) {
			$categoryFilter = [];
		}
		
		$categoryCount = count($categories);
		$filterCount = count($categoryFilter);
		
		if (!empty($words[0]) || (($filterCount != 0) && ($categoryCount != $filterCount))) {
			$resources = Resource::orderBy('name_romanization')->get();
		} else {
			$resources = Resource::where('name_romanization', 'like', $alpha . '%')->orderBy('name_romanization')->get();
			$this->page['resourceCount'] = count(Resource::orderBy('name_romanization')->get());
			$countSet = true;
		}
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
			
			$categoryIds = [];
			
			foreach ($attributes['categories'] as $c) {
				$categoryIds[] = $c->attributes['id'];
			}
			
			// add if in category
			if (!empty(array_intersect($categoryIds, $categoryFilter)) || empty($categoryFilter)) {
				
				// perform search on text input and on search fields
				if (empty($searchType)) {
					$resourceArray[] = $attributes;
				} elseif($words[0] == "") {
					$resourceArray[] = $attributes;
				} else {

					$added = false;

					if (in_array("title", $searchType) && $added == false) {
						// old search functionality
						/*
						$english = explode(' ', $attributes['name_english']);
						$english = array_map('strtolower', $english);
						
						$romanized = explode(' ', $attributes['name_romanization']);
						$romanized = array_map('strtolower', $romanized);
						
						if(!empty(array_intersect($words, explode(' ', $attributes['name_japanese']))) || !empty(array_intersect($words, $english)) || !empty(array_intersect($words, $romanized))) {
							$resourceArray[] = $attributes;
							$added = true;
						}
						*/
						
						$flag = array_strpos(strtolower($attributes['name_english']), $words);
							
						if ($added == false && $flag == true) {
							$resourceArray[] = $attributes;
							$added = true;
						}
							
						$flag = array_strpos(strtolower($attributes['name_romanization']), $words);
							
						if ($added == false && $flag == true) {
							$resourceArray[] = $attributes;
							$added = true;
						}
							
						$flag = array_strpos($attributes['name_japanese'], $words);
							
						if ($added == false && $flag == true) {
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
						
						if ($added == false) {
							$description_japanese = strip_tags($attributes['description_japanese']);
							$flag_jap = array_strpos($description_japanese, $words);

							if ($flag_jap) {
								$resourceArray[] = $attributes;
								$added = true;
							}
						}
					}
					
				}
			}
		}
		
		$ab = range('A', 'Z');
		$pagination = [];
		
		foreach ($ab as $a) {
			$resources = Resource::where('name_romanization', 'like', $a . '%')->get();
			$c = count($resources);
			
			if ($c == 0) {
				$has = 0;
			} else {
				$has = 1;
			}
			
			if ($a == $alpha) {
				$active = 1;
			} else {
				$active = 0;
			}
			
			$pagination[] = array(
				'letter'	=> $a,
				'has'		=> $has,
				'active'	=> $active
			);
		}
		
		$this->page['pagination'] = $pagination;
		$this->page['categories'] = $categories;
		$this->page['resources'] = $resourceArray;
		
		if ($countSet == false) {
			$this->page['resourceCount'] = count($resourceArray);
		}
    }
}