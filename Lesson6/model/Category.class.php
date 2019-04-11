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

}