<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.04.2019
 * Time: 12:09
 */

class Category
{

    public function getCategories($rootCategory = 0)
    {

        return Sql::getRows('SELECT * FROM `categories` WHERE `parent_id`=?', [$rootCategory]);

    }

    public function getCategory($id)
    {
        return Sql::getRow('SELECT * FROM `categories` WHERE `id_category`=?', [$id]);
    }

    public function getParentCategoryName($parentId){
        return Sql::getRow('SELECT `name` FROM `categories` WHERE `id_category`=?', [$parentId])['name'];
    }

//    public function
}