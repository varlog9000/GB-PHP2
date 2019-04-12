<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 12.04.2019
 * Time: 23:32
 */

class CartController extends Controller
{
    public $view = 'cart';
    public $title;
    public $category;
    public $goods;
    public $cart;
    public $statusMessage;
    public $currentCategories;
    public $paramContainer = [];


    public function __construct()
    {
        parent::__construct();
//        $this->title .= ' | Каталог товаров';
        $this->category = new Category();
        $this->goods = new Goods();
        $this->cart = new Cart();
//        $this->category = Db();
    }


    public function index($data)
    {
        $paramContainer['cart'] = $this->cart->getGoodsListFromCart();


    }

    public function add($data)
    {
        $this->cart->addGoodToCart($data['id']);
        return json_encode($this->cart->getGoodsListFromCart());
    }

    public function delete($data)
    {
        $this->cart->deleteGoodFromCart($data['id']);
        return json_encode($this->cart->getParamForCardBlock());
    }
}