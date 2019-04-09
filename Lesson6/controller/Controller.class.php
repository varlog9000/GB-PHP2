<?php

class Controller
{
    public $view = 'admin';
    public $title;

    function __construct()
    {
        $this->title = Config::get('sitename');
//        debug($_REQUEST);
    }

    public function index($data) {
        return [];
    }
}