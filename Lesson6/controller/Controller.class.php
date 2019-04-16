<?php

class Controller
{
    public $view = 'index';
    public $title;
    public $paramContainer=[];
    public $cart;

    function __construct()
    {

        $this->title = Config::get('sitename');


        $this->cart = new Cart();
        $this->paramContainer['cart_small']= [$this->cart->getParamForCartBlock()][0];
        $this->paramContainer['user_name']=$_SESSION['user_name'];
        $this->paramContainer['id_user']=$_SESSION['user_id'];
//        debug($_REQUEST);
    }

    public function index($data) {
        return [];
    }
}