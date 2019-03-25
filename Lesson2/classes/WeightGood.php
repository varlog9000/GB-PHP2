<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 23.03.2019
 * Time: 22:42
 */

class WeightGood extends PhysicalGood
{
    public function __construct($title=null, $description=null, $price=null)

    {
        parent::__construct($title, $description, $price);
        $this->setMeasurement('кг.');
    }

}