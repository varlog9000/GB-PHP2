<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.03.2019
 * Time: 20:29
 */


trait Singleton
{

    protected static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

}