<?php

namespace osp\src\components;

class OspReader
{
    protected $dir = null;
    public $projects = [];
    public $empty = [];
    
    public function __construct($dir)
    {
        $this->dir = rtrim($dir, DS) . DS;
    }
    
    public function readProjects()
    {
        $this->projects = [];
        $this->empty = [];

        $d = dir($this->dir);

        $dots = ['.','..'];

        while (false !== ($dirProject = $d->read())) {
            if (!in_array($dirProject,$dots)){
                $subfolder = $this->dir . $dirProject . DS . '.osp';
                if (file_exists($subfolder)){
                    $this->projects[] = $dirProject;
                }else{
                     $this->empty[] = $dirProject;
                }
            }
        }

        $d->close();        
    }
}