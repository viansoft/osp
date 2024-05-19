<?php

namespace osp\src\models;

class Program
{
    public $sections;
    
    public function __construct()
    {
    }    
    
    public function getFile()
    {
        return app()->dir('OSPanel') . 'config' . DS . 'program.ini';
    }
    
    public function read()
    {
        $file = $this->getFile();

        if (!file_exists($file)){
            $file = dirname(__DIR__) . DS . 'config' . DS . 'config.php';
            return [
                'result' => 'error',
                'message' => 'File {OSPanel}/config/program.ini not found.'
                    . '<br>Please, check if file <b>' . $file . '</b> contains correct path in the parameter <b>\'OSPanel\'</b>',
            ];
        }

        $this->sections = [];
        
        $string = file_get_contents($file);
        
        $string = str_replace('(x86)','__86__',$string);
        
        $sections = parse_ini_string($string,true,INI_SCANNER_RAW);
        
        foreach($sections as $name => $options){
            foreach($options as $key => $value){
                $value = str_replace('__86__','(x86)',$value);
                $options[$key] = $value;
            }
            $this->sections[] = new ProgramSection($name, $options);
        }

        return [
            'result' => 'success',
        ];
    }    

    public function setSections($sections)
    {
        $this->sections = [];
        
        foreach($sections as $name => $options){
            $this->sections[] = new ProgramSection($name, $options);
        }
    }

    public function write()
    {
        $content = '';

        foreach($this->sections as $section){
            $content .= $section->getFileContent();
        }
        
        $file = $this->getFile();
        
        if (file_exists($file)){
            $to = str_replace('program.ini','program.ini.' . date('Ymd_his'),$file);
            rename($file, $to);
        }

        file_put_contents($file,$content);
    }
}