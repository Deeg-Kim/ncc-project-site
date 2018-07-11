<?php namespace Dgkim\DigitalResourcesDb\Controllers;

use BackendAuth;
use Backend\Classes\Controller;
use Backend\Models\User;
use BackendMenu;
use Redirect;
use Flash;
use Dgkim\DigitalResourcesDb\Models\Resource;
use Dgkim\DigitalResourcesDb\Models\Blscan;
use Dgkim\DigitalResourcesDb\Models\Brokenlink;

class BrokenLinks extends Controller
{   
	public $implement = ['Backend\Behaviors\ListController'];
	
	public $listConfig = 'config_list.yaml';
	
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dgkim.DigitalResourcesDb', 'main-menu-item-drdb', 'side-menu-item-broken');
    }
	
	public function index() 
	{
		$this->pageTitle = "Broken Link Scanner";
		$this->asExtension('ListController')->index();
	}
	
	public function view($id)
	{
		$this->pageTitle = "View Scan Results";
		
		$scan = Blscan::find($id);
		if (empty($scan)) {
			Flash::error('Requested scan does not exist!');
		}
		
		$user = User::find($scan->scanned_by_id);
		
		$this->vars['scan'] = $scan;
		$this->vars['scanned_by'] = $user->first_name . ' ' . $user->last_name;
	}
	
	public function onScan()
	{
		$user = BackendAuth::getUser();
		
		$scan = new Blscan;
		$scan->scan_start = date("Y-m-d H:i:s");
		$scan->scanned_by_id = $user->id;
		$scan->scan_stop = date("Y-m-d H:i:s");
		$scan->save();
		
		$resources = Resource::all();
		
		foreach ($resources as $resource) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $resource->link);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
			$headers = curl_getinfo($ch);
			curl_close($ch);
			$status = $headers['http_code'];

			if (!($status == 200 || $status == 301 || $status == 302)) {
				$bl = new Brokenlink;
				$bl->blscan_id = $scan->id;
				$bl->resource_id = $resource->id;
				$bl->save;
				
				$scan->brokenlinks()->add($bl);
				$resource->brokenlinks()->add($bl);
			}
		}
		
		$scan->scan_stop = date("Y-m-d H:i:s");
		$scan->save();
		
		return Redirect::back();
	}
}
