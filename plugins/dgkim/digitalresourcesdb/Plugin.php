<?php namespace Dgkim\DigitalResourcesDb;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
		return [
			'Dgkim\DigitalResourcesDb\Components\ResourcesList'				 	=> 'resourcesList',
			'Dgkim\DigitalResourcesDb\Components\ResourceView'				 	=> 'resourceView',
		];
    }

    public function registerSettings()
    {
    }
}
