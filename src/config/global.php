<?php

define ('DS',DIRECTORY_SEPARATOR);

spl_autoload_register(static function ($class) {

    $localPath = str_replace('osp\\', '', $class);
    
    $file = dirname(dirname(__DIR__)) . DS . $localPath . '.php';

    if (file_exists($file)){
        include $file;
    }
});  

function app()
{
    return $GLOBALS['app'];
}

function controller()
{
    return app()->controller;
}

function inc($view, $params=[])
{
    $file = dirname(__DIR__) . DS . 'views' . DS . 'inc' . DS . $view . '.php';
    
    return app()->render($file,$params);
}