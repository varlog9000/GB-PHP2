<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 23.03.2019
 * Time: 22:42
 */


// Цифровой товар, измеряется в штуках, стоимость = (цена * количество)/2
class DigitalGood extends PhysicalGood
{

    public function calculateAmount()
    {
        return parent::calculateAmount()/2;
    }
}