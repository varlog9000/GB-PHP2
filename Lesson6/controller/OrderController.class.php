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

    public function index($data)
    {
        $this->paramContainer['order_list'] = $this->order->getOrderList();
//        App::debug($this->paramContainer['order_list'], 'order_list');

    }

    public function add($data)
    {
        if (isset($_SESSION['user_id'])) {
            if (isset($_REQUEST['getOrder'])) {
                $goodsInCart = $this->cart->getGoodsListFromCart();
                $countAndAmount = $this->cart->getParamForCartBlock();
                if ($countAndAmount['count']>1){
                    App::debug($goodsInCart, 'goodsInCart');
                    $id_order = $this->order->createOrder();
//            App::debug($id_order, 'id_order');
                    for ($i = 0; $i < count($goodsInCart); $i++) {
//                App::debug($goodsInCart[$i]['id_basket'], 'id_basket');
//                App::debug($goodsInCart[1]['id_basket'], 'id_basket[1]');

                        $this->cart->updateGoodForOrder($id_order, $goodsInCart[$i]['id_basket']);
                    }
                    $this->order->updateOrder($id_order, $_REQUEST['owner_name'], $_REQUEST['phone'], $_REQUEST['address'], $countAndAmount['amount']);
                    header("location:index.php?path=order");
                }else{
                    header("location:index.php?path=catalog");
                }
//
            }
        }else{
            header("location:index.php?path=user");
        }


    }

    public function view($data)
    {
        if (isset($_GET['id'])) {
            $goodsInOrder = $this->order->getOrder($_GET['id']);
            $this->paramContainer['h1'] = "Заказ №" . $_GET['id'];
            $this->paramContainer['order'] = $goodsInOrder;
//            App::debug($goodsInOrder,'$goodsInOrder=');
        }
    }


}