<?php

class OrderController extends Controller
{
   public function add($data){
       if (isset($_SESSION['id_user'])){
           $goodsInCart = $this->cart->getGoodsListFromCart();

       }
   }


}