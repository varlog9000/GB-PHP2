<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 23.03.2019
 * Time: 22:43
 */

// Физический товар, измеряется в штуках, стоимость = цена * количество
class PhysicalGood extends Good
{
    public function __construct($title, $description, $price)

    {
        parent::__construct($title, $description, $price);
        $this->setMeasurement('шт.');
    }

    public function calculateAmount()
    {
        return ($this->getPrice()) * ($this->getQuantity());
    }
}