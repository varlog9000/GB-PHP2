<?php

class AdminController extends Controller
{

    public $view = 'admin';
    public $category;
    public $goods;
//    public $cart;
    public $orders;
    public $statusMessage;
    public $adminControl;

    public function __construct()
    {
        parent::__construct();

        $this->title .= ' | Админка';
        $this->adminControl = new Admin();
        $this->orders = new Orders();

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

    public function edit_order($data)
    {
        $this->paramContainer['h1'] = 'Заказ';
        $this->title .= ' | ' . $this->paramContainer['h1'];

        if (isset($_GET['id'])) {
            if (isset($_REQUEST['update']) || isset($_REQUEST['update-and-close'])) {
//                App::debug($_REQUEST, 'Request');
                $this->adminControl->updateOrder($_GET['id'], $_REQUEST['owner_name'], $_REQUEST['phone'], $_REQUEST['address'], $_REQUEST['id_order_status']);
//                print_r($_REQUEST['owner_name']);
                if (isset($_REQUEST['update-and-close'])) {
                    header("location:index.php?path=admin/order_list");
                }
            } elseif (isset($_REQUEST['close'])) {
                header("location:index.php?path=admin/order_list");
            }
            $this->paramContainer['order_status_list'] = $this->adminControl->getDropDownList('order_status', 'id_order_status', 'order_status_name');
//        $this->paramContainer['order_status_list'] = $this->adminControl->getDropDownList('order_status');
            $this->paramContainer['order'] = $this->adminControl->getOrder($_GET['id']);
//      App::debug($this->paramContainer['order'],'$this->paramContainer[order]');
            $this->paramContainer['order_goods'] = $this->adminControl->getOrderGoods($_GET['id']);
//        App::debug($this->paramContainer['order_goods'],'$this->paramContainer[order_goods]');

        } else {
            header("location:index.php?path=admin/order_list");
        }
    }

}