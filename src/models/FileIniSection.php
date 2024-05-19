<?php

namespace osp\src\models;

class FileIniSection
{
    public $name;
    public $options = [];
    
    public $keys = [
    ];
    
    public function __construct($name, $options)
    {
        $this->name = $name;    
        
        $keys = array_keys($this->fields());
        
        $this->options = $options; 
        
        foreach($keys as $key){
            if (!isset($this->options[$key])){
                $this->options[$key] = '';
            }
        }    

    }        

    public function fields()
    {
        return [];
    }
    
    public function getFileContent()
    {        
        $lines = [];
        
        $lines[] = '[' . $this->name . ']';
        // $lines[] = PHP_EOL;

        foreach($this->options as $option => $value){
            if (strlen($value)){
                $space = 30 - strlen($option);
                $lines[] = $option . str_repeat(" ",$space) . '= ' . $value;
            }    
        }
        
        return implode(PHP_EOL,$lines) . PHP_EOL;
    }
}