<?php namespace Dgkim\DigitalResourcesDb\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class BrokenLinks extends Controller
{
    public $implement = [    ];
    
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dgkim.DigitalResourcesDb', 'main-menu-item-drdb', 'side-menu-item-broken');
    }
}
