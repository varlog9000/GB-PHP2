<?php

class OrderController extends Controller
{
    public $order;
    public $view = 'order';

    public function __construct()
    {
        parent::__construct();
        $this->order = new Orders();

    }

    public function add($data)
    {
        if (isset($_SESSION['id_user'])) {

        }
        if (isset($_REQUEST['getOrder'])) {
            $goodsInCart = $this->cart->getGoodsListFromCart()[0];
            App::debug($goodsInCart);
            $id_order = $this->order->createOrder();
            App::debug($id_order);
            foreach ($goodsInCart as $good) {
                $this->cart->updateGoodForOrder($id_order, $good['id_basket']);
            }
            $this->order->updateOrder($id_order,$_REQUEST['owner_name'],$_REQUEST['phone'],$_REQUEST['address']);
            header("location:index.php?path=order");
        }

    }

    public function index($data){
        $this->paramContainer['order_list'] = $this->order->getOrderList();
        App::debug($this->paramContainer['order_list']);

    }


}