<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 23.03.2019
 * Time: 22:42
 */

// Весовой товар, измеряется в килограммах, стоимость = цена * количество
class WeightGood extends PhysicalGood
{
    public function __construct($title=null, $description=null, $price=null)

    {
        parent::__construct($title, $description, $price);
        $this->setMeasurement('кг.');
    }

}