<?php namespace Dgkim\DigitalResourcesDb\Components;

use Auth;
use Input;
use Validator;
use Redirect;
use Flash;
use Response;
use Session;
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

	function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
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

		$categories = Category::orderBy('name_english')->get();

		$alpha = get('r');
		if (get('st') == '' || post('submit')) {
        	$words = post('search');
			$offset = get('page');
			$searchType = post('searchType');
			$categoryFilter = post('categoryFilter');
		} else {
			$words = get('q');
			$offset = get('page');
			$searchType = unserialize(get('st'));
			$categoryFilter = unserialize(get('cf'));
		}
        $q = $words;
		if (post('submit')) {
			$offset = 1;
		}

		$full = $words;
		$words = explode(' ', $words);
		$words = array_map('strtolower', $words);
		$in_page = 10; // number of entries per page of each romanization

		if ($alpha == null) {
			$alpha = 'A';
		}

		if ($offset == null) {
			$offset = 1;
		}

		if (empty($categoryFilter)) {
			$categoryFilter = [];
		}

		$categoryCount = count($categories);
		$filterCount = count($categoryFilter);

		if (!empty($words[0]) || (($filterCount != 0) && ($categoryCount != $filterCount))) {
			$searched = true;
			$resources = Resource::orderBy('name_romanization')->get();
		} else {
			$searched = false;
			$count = Resource::where('name_romanization', 'like', $alpha . '%')->count();
			$page_count = ceil($count/$in_page);

			$resources = Resource::where('name_romanization', 'like', $alpha . '%')
				->orderBy('name_romanization')
				->skip(($offset - 1) * $in_page)
				->limit($in_page)
				->get();
		}
		$resourceArray = [];

		foreach ($resources as $resource) {

			$attributes = $resource->attributes;

			$attributes['categories'] = $resource->categories;

			// build description blurbs
			if ($resource->description != "") {
				$str = $resource->description;
				// preg_match('/<p>(.*?)<\/p>/i', $str, $paragraphs);
				$paragraphs = preg_split('/<\/\s*p\s*>/', $str);

				if (!empty($paragraphs[1])) {
					if (strlen(strip_tags($paragraphs[0])) > 150) {
						$attributes['description_blurb'] = $paragraphs[0];
					} else {
						$attributes['description_blurb'] = $paragraphs[0] . $paragraphs[1];
					}
				} else {
					$attributes['description_blurb'] = $paragraphs[0];
				}
			} else {
				$attributes['description_blurb'] = "";
			}

			if ($resource->description_japanese != "") {
				$str = $resource->description_japanese;
				// preg_match('/<p>(.*?)<\/p>/i', $str, $paragraphs);
				$paragraphs = preg_split('/<\/\s*p\s*>/', $str);

				if (!empty($paragraphs[1])) {
					if (strlen(strip_tags($paragraphs[0])) > 150) {
						$attributes['description_japanese_blurb'] = $paragraphs[0];
					} else {
						$attributes['description_japanese_blurb'] = $paragraphs[0] . $paragraphs[1];
					}
				} else {
					$attributes['description_japanese_blurb'] = $paragraphs[0];
				}
			} else {
				$attributes['description_japanese_blurb'] = "";
			}

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

						if(!empty(array_intersect($keywords, $words)) || !empty(array_intersect($keywords, array($full)))) {
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

		$this->page['resourceCount'] = count($resourceArray);

		if ($searched) {
			$count = count($resourceArray);
			$page_count = ceil($count/$in_page);

			$resources = Resource::where('name_romanization', 'like', $alpha . '%')
				->orderBy('name_romanization')
				->skip(($offset - 1) * $in_page)
				->limit($in_page)
				->get();

			if (!empty($resourceArray)) {
				$paginatedArray = array();
				$total = count($resourceArray);
				for ($i = 0; $i < $in_page; $i++) {
					if ((($offset - 1) * $in_page + $i) < $total) {
						$paginatedArray[] = $resourceArray[($offset - 1) * $in_page + $i];
					}
				}

				$resourceArray = $paginatedArray;
			}

            $page_data = ['searched' => true, 'q' => $q, 'page' => $offset, 'st' => serialize($searchType), 'cf' => serialize($categoryFilter)];
		} else {
            $page_data = ['searched' => false, 'r' => $alpha, 'page' => $offset];
        }
        Session::flash('page.data', $page_data);

		$this->page['pagination'] = $pagination;
		$this->page['categories'] = $categories;
		$this->page['resources'] = $resourceArray;

		$this->page['searched'] = $searched;

		if ($searched) {
			$this->page['words'] = $full;
			$this->page['searchType'] = serialize($searchType);
			$this->page['categoryFilter'] = serialize($categoryFilter);
		}

		$this->page['pageCount'] = $page_count;
		$this->page['offset'] = $offset;
		$this->page['alpha'] = $alpha;
		$this->page['totalCount'] = Resource::count();
    }
}
