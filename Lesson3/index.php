<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27.03.2019
 * Time: 19:03
 */

require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();
try {
    $loader = new Twig_Loader_Filesystem('templates');
} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}