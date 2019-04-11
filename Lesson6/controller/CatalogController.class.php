<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.04.2019
 * Time: 11:50
 */

class CatalogController extends Controller
{
    public $view = 'catalog';
    public $title;
    public $link;
    public $statusMessage;

    public function __construct()
    {
        parent::__construct();
        $this->title .= ' | Каталог товаров';
//        $this->link = Db();
    }


    function index($data)
    {

        return [];
    }


}