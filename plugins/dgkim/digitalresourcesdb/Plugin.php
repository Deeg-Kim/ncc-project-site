<?php namespace Dgkim\DigitalResourcesDb;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
		return [
			'Dgkim\DigitalResourcesDb\Components\ResourcesList'				 	=> 'resourcesList',
		];
    }

    public function registerSettings()
    {
    }
}
