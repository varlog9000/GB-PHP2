<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 23.03.2019
 * Time: 22:42
 */

class DigitalGood extends PhysicalGood
{

    public function calculateAmount()
    {
        return parent::getPrice()/2** ($this->getQuantity());
    }
}