<?php namespace Dgkim\DigitalResourcesDb\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Resources extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dgkim.DigitalResourcesDb', 'main-menu-item-drdb', 'side-menu-item-resources');
    }
}
