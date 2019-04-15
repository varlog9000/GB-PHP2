<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 16.04.2019
 * Time: 0:17
 */

class Orders
{

    public $cart;

    public function transferCartToOrder($data)
    {
        $this->cart = new Cart();
        $goods = $this->cart->getGoodsListFromCart();

    }
}