<?php

namespace osp\src\controllers;

class StandartController
{
    const ACTION_FUNCTION = 1;
    const ACTION_VIEW = 2;
    
    // public $layout = 'main';
    public $layout = 'adminlte';
    
    public $defaultAction = 'index';
    public $action;
    protected $actionType;
    
    protected $title = '';
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getBreadcrumb()
    {
        return '';
        /*    

            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/project/create/" class="btn btn-primary" data-width="800" data-title="' . $this->dir . '" data-toggle="lightbox">New project</a></li>
            </ol>
        */          
    }

    public function run()
    {
        $this->defineAction();
        
        switch($this->actionType){
        case self::ACTION_FUNCTION:
            $function = 'action' . ucfirst($this->action);
            return $this->$function();
            break;
        case self::ACTION_VIEW:
            return $this->render($this->action);
            break;
        }
    }
    
    public function getDirView()
    {
        $dirController = str_replace('controller','',strtolower(basename(get_class($this))));
        
        return app()->dir('views') . $dirController . DS;
    }
    
    public function getViewForAction($action)
    {
        return $this->getDirView() . $action . '.php';
    }
    
    public function isViewExistForAction($action)
    {
        return file_exists($this->getViewForAction($action));
    }

    public function render($file)
    {
        $view = $this->getViewForAction($file);
        
        if (file_exists($view)){
            // $content = $this->_renderInternal($view);
            $content = app()->render($view);
        }else{
            $content = '';
        }    
        
        return $this->renderContent($this->renderPartial($file));
    }

    public function renderPartial($file, $data=null)
    {
        $view = $this->getViewForAction($file);
        
        if (file_exists($view)){
            // return $this->_renderInternal($view, $data);
            return app()->render($view, $data);
        }else{
            return '';
        }    
    }    
    
    public function renderContent($content)
    {
        $file = app()->dir('layouts') . $this->layout . '.php';
        
        // return $this->_renderInternal($file,['content'=>$content]);
        return app()->render($file,['content'=>$content]);
    }
    
    /*
	protected function _renderInternal($_viewFile_,$_data_=null)
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
    */
    
    protected function getActionsFunction()
    {
        $actions = [];
        
        $methods = get_class_methods($this);
        
        foreach($methods as $method){
            $method = strtolower($method);
            if (substr($method,0,6) == 'action'){
                $actions[] = substr($method,6);
            }
        }
        
        return $actions;
    }
    
    public function defineAction()
    {
        $action = null;
        
        if (isset(app()->url[2])){                
            if (in_array(app()->url[2],$this->getActionsFunction())){
                $action = app()->url[2];
                $this->actionType = self::ACTION_FUNCTION;
            }elseif($this->isViewExistForAction(app()->url[2])){
                $action = app()->url[2];
                $this->actionType = self::ACTION_VIEW;
            }
        }
        
        if ($action){
            $this->action = $action;
        }elseif($this->isViewExistForAction($this->defaultAction)){
            $this->action = $this->defaultAction;
            $this->actionType = self::ACTION_VIEW;
        }else{
            throw new \Exception('There are no defined action for the controller ' . get_class($this));            
        }
    }
    
    public function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
}