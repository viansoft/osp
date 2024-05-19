<?php

namespace osp\src\models;

class Domain extends FileIniSection
{
    /*
    $defauts = [
        'php_engine' => 'PHP-8.0',
    ];    
    */
    
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
    


    public function fields()
    {
        return [
            'aliases' => [
                'type' => 'text',
            ],
            'enabled' => [
                'type' => 'select',
                'items' => self::allOnOff(),
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
                'type' => 'select',
                'items' => self::allOnOff(),
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
    
    static public function allOnOff()
    {
        $vals = [
            '',
            'on',
            'off',
        ];
        
        $res = [];
        
        foreach($vals as $val){
            $res[$val] = $val;            
        }
        
        return $res;
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
        
        $res = [];
        
        foreach($versions as $version){
            $val = 'PHP-' . $version;
            $res[$val] = $val;            
        }
        
        return $res;
    }
}