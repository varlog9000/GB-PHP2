<?php

class AdminController extends Controller
{

    public $view = 'admin';
    public $category;
    public $goods;
//    public $cart;
    public $statusMessage;
    public $adminControl;

    public function __construct()
    {
        parent::__construct();

        $this->title .= ' | Админка';
        $this->adminControl = new Admin();
    }

    public function index($data)
    {
        $this->paramContainer['h1'] = 'Админка';

    }

    public function order_list($data)
    {
        $this->paramContainer['h1'] = 'Заказы';
        $this->title .= ' | ' . $this->paramContainer['h1'];
        $this->paramContainer['order_list'] = $this->adminControl->getAllOrderList();
    }

}