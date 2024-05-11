<?php

namespace osp\src\models;

use osp\src\components\OspReader;

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
            'dir' => 'Dir',
            'domains' => 'Domains',
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
    
    public function read()
    {
        $this->domains = [];

        $file = app()->dir('projects') . $this->dir . DS . '.osp' . DS . 'project.ini';
        
        if (!file_exists($file))
            return;
        
        $domainsStr = OspReader::fileToDomainsStr($file);
        
        foreach($domainsStr as $str){
            $this->domains[] = OspReader::strToDomain($str);
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
        
        $file = app()->dir('projects') . $this->dir . DS . '.osp' . DS . 'project.ini';
        
        if (file_exists($file)){
            $to = str_replace('project.ini','project.ini.' . date('Ymd_his'),$file);
            rename($file, $to);
        }

        file_put_contents($file,$content);
    }
}