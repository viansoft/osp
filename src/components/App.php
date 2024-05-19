<?php

namespace osp\src\components;

class App
{
    public $defaultControllerName = 'project';
    public $controllerName;
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
            'OSPanel' => rtrim($config['OSPanel'],DS) . DS,
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
            'system',
        ];
        
        if (in_array($this->url[1],$controllers)){
            $this->controllerName = $this->url[1];
        }else{    
            $this->controllerName = $this->defaultControllerName;
        }
        
        $code = '$this->controller = new osp\src\controllers\\' . ucfirst($this->controllerName) . 'Controller();';
        
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
    
	public function render($_viewFile_,$_data_=null)
	{
		if(is_array($_data_))
			extract($_data_,EXTR_PREFIX_SAME,'data');
		else
			$data=$_data_;

        ob_start();
        ob_implicit_flush(false);
        require($_viewFile_);
        return ob_get_clean();
	}
}