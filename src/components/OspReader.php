<?php

namespace osp\src\components;

use osp\src\models\Project;
use osp\src\models\Domain;

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
    
    
    static public function fileToDomainsStr($file)
    {
        $str = file_get_contents($file);
    
        preg_match_all('/\[.+\]/', $str, $allMatches);
    
        $matches = $allMatches[0];
    
        $count = count($matches);
    
        for($i = 0; $i < $count-1; $i++){
            $pos = strpos($str,$matches[$i+1]);
            $domains[$i] = substr($str,0,$pos);
            $str = substr($str,$pos);
        }

        $domains[$i] = $str;
    
        return $domains;
    }    

    static public function strToDomain($str)
    {
        preg_match('/\[.+\]/', $str, $match);
    
        $str = str_replace($match,'',$str);
    
        $lines = explode(PHP_EOL, $str);
    
        $res = [];
    
        $name = trim($match[0],'[]');

        $options = [];
    
        foreach($lines as $line){
            if (strpos($line,'=')){
                $a = explode('=',$line);
                $options[trim($a[0])] = trim($a[1]);
            }    
        }
    
        return new Domain($name,$options);        
    }    
}