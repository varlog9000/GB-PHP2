<?php
const DRIVER = 'mysql';
const SERVER = 'localhost';
const DB = 'learn_db';
const USERNAME = 'root';
const PASSWORD = '';

$config['db_driver'] = DRIVER;
$config['db_user'] = USERNAME;
$config['db_password'] = PASSWORD;
$config['db_base'] = DB;
$config['db_host'] = SERVER;
$config['db_charset'] = 'UTF-8';
$config['path_images'] = 'images';
$config['path_img_category'] = $config['path_images'] . '/categories';
$config['path_img_good'] = $config['path_images'] . '/goods';

$config['path_root'] = __DIR__;
$config['path_public'] = $config['path_root'] . '/../public';
$config['path_model'] = $config['path_root'] . '/../model';
$config['path_controller'] = $config['path_root'] . '/../controller';
$config['path_cache'] = $config['path_root'] . '/../cache';
$config['path_data'] = $config['path_root'] . '/data';
$config['path_fixtures'] = $config['path_data'] . '/fixtures';
$config['path_migrations'] = $config['path_data'] . '/../migrate';
$config['path_commands'] = $config['path_root'] . '/../lib/commands';
$config['path_libs'] = $config['path_root'] . '/../lib';
$config['path_templates'] = $config['path_root'] . '/../templates';

$config['path_logs'] = $config['path_root'] . '/../logs';

$config['sitename'] = 'Пожарный магазин';