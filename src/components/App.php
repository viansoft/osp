<?php

namespace osp\src\components;

class App
{
    public $defaultController = 'project';
    public $controller;
    public $url = [];
    
    protected $config = [
        'dir' => [],
    ];
    
    public function __construct($config)
    {
        $this->setDir($config);
    }

    public function setDir($config)
    {
        $app = dirname(dirname(__DIR__)) . DS;
        $src = $app . 'src' . DS;
        $views = $src . 'views' . DS;
        $layouts = $src . 'layouts' . DS;
        
        $this->config['dirs'] = [
            'projects' => rtrim($config['projects'],DS) . DS,
            'app' => $app,
            'src' => $src,
            'views' => $views,
            'layouts' => $layouts,
        ];
    }
    
    public function run()
    {
        $this->defineRequest();
        $this->defineController();
        
        echo $this->controller->run();
    }
    
    public function defineRequest()
    {
        $url = str_replace($_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
        $url = rtrim($url,'?');
        $this->url = explode('/',strtolower($url));
    }
    
    public function defineController()
    {
        $controllers = [
            'project',
        ];
        
        if (in_array($this->url[1],$controllers)){
            $controller = $this->url[1];
        }else{    
            $controller = $this->defaultController;
        }
        
        $code = '$this->controller = new osp\src\controllers\\' . ucfirst($controller) . 'Controller();';
        
        eval($code);
    }
    
    public function dir($name)
    {
        if (isset($this->config['dirs'][$name])){
            return $this->config['dirs'][$name];
        }else{
            throw new \Exception('Dir "' . $name . '" is not defined');
        }    
    }

    public function end()
    {
        exit();
    }
}