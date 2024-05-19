<?php

namespace osp\src\models;

class Project
{
    public $dir;
    public $domains;
    
    public function __construct($dir)
    {
        $this->dir = $dir;    
    }    
    
    public function create()
    {
        $folder = app()->dir('projects') . $this->dir . DS . '.osp';
        
        if (!file_exists($folder)){
            mkdir($folder);
        }    
        
        $this->domains[] = new Domain($this->dir,[]);
        
        $this->write();
    }    

    static public function labels()
    {
        return [
            'domains' => 'Domains',
            'dir' => 'Dir',
            'actions' => '',
        ];
    }
    
    public function getDomains()
    {
        return $this->getDomainLinks();
    }
    
    public function getDomainLinks($diff='<br>')
    {
        $res = [];
        
        foreach($this->domains as $domain){
            $res[] = '<a href="http://' . $domain->name . '" target="_blank">' . $domain->name . '</a>';
        }
        
        return implode($diff, $res);
    }
    
    public function getActions()
    {
        return '<a href="/project/update/?project=' . $this->dir . '" title="Edit" data-width="800" data-title="' . $this->dir . '" data-toggle="lightbox"><i class="fa-regular fa-rectangle-list"></i></a>';
    }

    public function getFile()
    {
        return app()->dir('projects') . $this->dir . DS . '.osp' . DS . 'project.ini';;
    }    
    
    public function read()
    {
        $this->domains = [];

        $file = $this->getFile();
        
        if (!file_exists($file))
            return;
        
        $domains = parse_ini_file($file,true);
        
        foreach($domains as $name => $options){
            
            foreach(['ssl','enabled'] as $key){
                $options[$key] = isset($options[$key]) ? ($options[$key] ? 'on' : 'off')  : '';
            }
            
            $this->domains[] = new Domain($name, $options);
        }
    }    

    public function setDomains($domains)
    {
        $this->domains = [];
        
        foreach($domains as $options){
            $name = $options['name'];
            unset($options['name']);
            $this->domains[] = new Domain($name, $options);
        }
    }

    public function write()
    {
        $content = '';

        foreach($this->domains as $domain){
            $content .= $domain->getFileContent();
        }
        
        $file = $this->getFile();
        
        if (file_exists($file)){
            $to = str_replace('project.ini','project.ini.' . date('Ymd_his'),$file);
            rename($file, $to);
        }

        file_put_contents($file,$content);
    }
}