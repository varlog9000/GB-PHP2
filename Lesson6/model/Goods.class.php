<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.04.2019
 * Time: 0:38
 */

class Goods
{

    public function getGoodsFromCategory($id){
        return Sql::getRows('SELECT * FROM `goods` WHERE `id_category`=?',[$id]);
    }

    public function getGood($id){
        return Sql::getRows('SELECT * FROM `goods` WHERE `id_good`=?',[$id]);
    }

}