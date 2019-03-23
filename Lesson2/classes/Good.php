<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 23.03.2019
 * Time: 22:30
 */

abstract class Good
{
    private $title;
    private $description;
    private $property;
    private $measurement;
    private $price;
    private $currency;
    private $quantity;

    public function setTitle($title)
    {
    $this->title=$title;
    }

    public function setDescription($description)
    {
        $this->description=$description;
    }

    public function setProperty($property)
    {
        $this->property=$property;
    }
    public function setMeasurement($measurement)
    {
        $this->measurement=$measurement;
    }
    public function setPrice($price)
    {
        $this->price=$price;
    }
    public function setCurrency($currency)
    {
        $this->currency=$currency;
    }
    public function setQuantity($quantity)
    {
        $this->quantity=$quantity;
    }

}