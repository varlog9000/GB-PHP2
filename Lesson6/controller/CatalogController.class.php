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
    public $category;
    public $goods;
    public $statusMessage;
    public $currentCategories;
    public $paramContainer = [];


    public function __construct()
    {
        parent::__construct();
//        $this->title .= ' | Каталог товаров';
        $this->category = new Category();
        $this->goods = new Goods();
//        $this->category = Db();

    }


    public function index($data)
    {
        $id = isset($data['id']) ? $data['id'] : 0;
        if ($id != 0) {
            $name = $this->category->getCategory($id)['name'];
            $this->title .= " | $name";
            $this->paramContainer['h1'] = $name;
        } else {
            $this->paramContainer['h1'] = 'Каталог товаров';
            $this->title .= ' | Каталог товаров';
//            $this->paramContainer['parent_link']['status']=0;
        }
        $this->paramContainer['parent_link']['parent_id'] = $this->category->getCategory($id)['parent_id'];
        $this->paramContainer['parent_link']['name'] = $this->category->getParentCategoryName($this->paramContainer['parent_link']['parent_id']);

        $this->paramContainer['categories'] = $this->category->getCategories($id);
//        echo "id= $id ";
        if (empty($this->paramContainer['categories'])) {
            header("location:index.php?path=catalog/goods/$id");
        }
//        else {
//            $this->paramContainer['categories'] = $this->category->getCategories($id);
//        }


//        App::debug($data);
        return [];
    }

    public function goods($data)
    {

        $id = isset($data['id']) ? $data['id'] : 0;
//        echo $data['id'];
        if ($id != 0) {
            $this->paramContainer['goods'] = $this->goods->getGoodsFromCategory($id);
            $name = $this->category->getCategory($id)['name'];
            $this->title .= " | $name";
            $this->paramContainer['h1'] = $name;
        } else {
            $this->paramContainer['h1'] = 'Каталог товаров';
            $this->title .= ' | Каталог товаров';
//            $this->paramContainer['parent_link']['status']=0;
        }
        $this->paramContainer['parent_link']['parent_id'] = $this->category->getCategory($id)['parent_id'];
        $this->paramContainer['parent_link']['name'] = $this->category->getParentCategoryName($this->paramContainer['parent_link']['parent_id']);
//        App::debug($_SERVER);
        return [];

    }

    public function good($data)
    {

        $id = isset($data['id']) ? $data['id'] : 0;
//        echo $data['id'];
        if ($id != 0) {
            $this->paramContainer['good'] = $this->goods->getGood($id);
            $name = $this->category->getCategory($this->paramContainer['good']['id_category'])['name'];
            $this->title .= " | $name";
            $this->paramContainer['h1'] = $name;
        } else {
            $this->paramContainer['h1'] = 'Каталог товаров';
            $this->title .= ' | Каталог товаров';
//            $this->paramContainer['parent_link']['status']=0;
        }
        $this->paramContainer['parent_link']['parent_id'] = $this->goods->getGood($id)['id_category'];
        $this->paramContainer['parent_link']['name'] = $this->category->getParentCategoryName($this->paramContainer['parent_link']['parent_id']);

        return [];

    }


}