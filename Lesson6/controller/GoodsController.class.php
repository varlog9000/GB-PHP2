<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.04.2019
 * Time: 0:37
 */

class GoodsController extends Controller
{
    public $view = 'catalog';
    public $title;
    public $goods;
    public $category;
    public $paramContainer = [];


    public function __construct()
    {
        parent::__construct();
//        $this->title .= ' | Каталог товаров';
        $this->goods = new Goods();
        $this->category = new Category();
//        $this->link = Db();
    }


    function index($data)
    {
        $id = isset($data['id']) ? $data['id'] : 0;
        echo $data['id'];
        if ($id != 0) {
            $this->paramContainer['goods'] = $this->goods->getGoodsFromCategory($id);
            $name=$this->category->getCategory($id)['name'];
            $this->title .= " | $name";
            $this->paramContainer['h1'] = $name;
        } else {
            $this->paramContainer['h1'] = 'Каталог товаров';
            $this->title .= ' | Каталог товаров';
//            $this->paramContainer['parent_link']['status']=0;
        }
        $this->paramContainer['parent_link']['parent_id'] = $this->category->getCategory($id)['parent_id'];
        $this->paramContainer['parent_link']['name'] = $this->category->getParentCategoryName($this->paramContainer['parent_link']['parent_id']);

        return [];
    }
}