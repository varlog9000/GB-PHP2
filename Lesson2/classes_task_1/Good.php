<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 23.03.2019
 * Time: 22:30
 */


// Абстрактный класс товара, задающий каркас
abstract class Good
{
    private $title; // Название товара
    private $description; // Описание
    private $measurement; //Единица измерения
    private $price; // Цена
    private $quantity=0; // Количество

    // Создаем товар с именем, описанием, ценой
    public function __construct($title = null, $description = null, $price = null)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setPrice($price);
    }

    // Добавляем товар в корзину, расчитывая стоимость и воводя это все на экран
    public function addToCart($quantity = 1)
    {
        $this->setQuantity($quantity);  // Устанавливаем количество товара
        $amount = $this->calculateAmount(); // Запускаем расчет стоимости

        return "Добавлено в корзину. Товар: $this->title, цена: $this->price, количество: $this->quantity $this->measurement,стоимость: $amount";
    }

    // Выводим карточку товара
    public function viewProductCard()
    {
        return "Товар: $this->title,<br>Описание: $this->description <br>Цена: $this->price за $this->measurement";
    }

    // В потомках должен быть метод расчета стоимости товара
    abstract function calculateAmount();

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setMeasurement($measurement)
    {
        $this->measurement = $measurement;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getMeasurement()
    {
        return $this->measurement;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

}