<?php

namespace AtlSoftware\Resources;

use Dotenv\Dotenv;

class Configuration
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../../');
        $dotenv->load();

        define('app_name', $_ENV['app_name']);
        define('app_env',  $_ENV['app_env']);
        define('app_debug', $_ENV['app_debug']);
        define('db_driver', $_ENV['db_driver']);
        define('db_host', $_ENV['db_host']);
        define('db_name', $_ENV['db_name']);
        define('db_user', $_ENV['db_user']);
        define('db_password', $_ENV['db_password']);
    }
}