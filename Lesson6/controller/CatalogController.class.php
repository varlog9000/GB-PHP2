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
    public $currentCategories;


    public function __construct()
    {
        parent::__construct();
        $this->title .= ' | Каталог товаров';
        $this->link = new Category();
//        $this->link = Db();
    }


    function index($data)
    {
        $id=isset($data['id'])?$data['id']:0;
//        echo "id= $id ";
        $this->currentCategories = $this->getCategories($id);
//        App::debug($data);
        return [];
    }


    public function getCategories($rootCategory = 0)
    {

        return Sql::getRows('SELECT * FROM `categories` WHERE `parent_id`=?', [$rootCategory]);

    }

}