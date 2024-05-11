<?php

namespace osp\src\models;

class Domain
{
    public $name;
    public $options = [];
    
    /*
    $defauts = [
        'php_engine' => 'PHP-8.0',
    ];    
    */
    
    public $keys = [
    ];

    static public function fields()
    {
        return [
            'aliases' => [
                'type' => 'text',
            ],
            'enabled' => [
                'type' => 'text',
            ],
            'environment' => [
                'type' => 'text',
            ],
            'ip' => [
                'type' => 'text',
            ],
            'nginx_engine' => [
                'type' => 'text',
            ],
            'node_engine' => [
                'type' => 'text',
            ],
            'php_engine' => [
                'type' => 'select',
                'items' => self::allPhpEngine(),
            ],
            'project_dir' => [
                'type' => 'text',
            ],
            'project_url' => [
                'type' => 'text',
            ],
            'public_dir' => [
                'type' => 'text',
            ],
            'ssl' => [
                'type' => 'text',
            ],
            'ssl_cert_file' => [
                'type' => 'text',
            ],
            'ssl_key_file' => [
                'type' => 'text',
            ],
            'start_command' => [
                'type' => 'text',
            ],
            'terminal_codepage' => [
                'type' => 'text',
            ],
        ];
    }
    
    static public function allPhpEngine()
    {
        $versions = [
            '7.2',
            '7.3',
            '7.4',
            '8.0',
            '8.1',
            '8.2',
            '8.3',
        ];
        
        // $res = ['' => ''];
        $res = [];
        
        foreach($versions as $version){
            $val = 'PHP-' . $version;
            $res[$val] = $val;            
        }
        
        return $res;
    }
    
    public function __construct($name, $options)
    {
        $this->name = $name;    
        
        $keys = array_keys(self::fields());
        
        $this->options = $options; 
        foreach($keys as $key){
            if (!isset($this->options[$key])){
                $this->options[$key] = '';
            }
        }    
/*
aliases           = www alias-example.local
enabled           = on
environment       = System
ip                = auto
nginx_engine      = 
node_engine       = 
php_engine        = PHP-8.1
project_dir       = {base_dir}
project_url       = https://{host_decoded}
public_dir        = {base_dir}\public
ssl               = on
ssl_cert_file     = auto
ssl_key_file      = auto
start_command     = 
terminal_codepage = 65001        
*/
    }    
    
    public function getFileContent()
    {        
        $lines = [];
        
        $lines[] = '[' . $this->name . ']';
        // $lines[] = PHP_EOL;

        foreach($this->options as $option => $value){
            if (strlen($value)){
                $space = 18 - strlen($option);
                $lines[] = $option . str_repeat(" ",$space) . '= ' . $value;
            }    
        }
        
        return implode(PHP_EOL,$lines) . PHP_EOL;
    }
}