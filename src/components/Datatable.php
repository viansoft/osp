<?php

namespace osp\src\components;

class Datatable
{
    public static function content($options=[])
    {
        return self::top($options) 
            . self::head($options)
            . self::body($options)
            . self::footer($options)
            . self::bottom($options)
            . self::js($options);            
    }
    
    public static function id($options=[])
    {
        return isset($options['id']) ? $options['id'] : 'datatable';
    }
    
    public static function top($options=[])
    {
        if (isset($options['top'])){
            return $options['top'];
        }
        
        // $style = 'white.border';
        // $class = isset($options['class']) ? $options['class'] : '';
        
        $id = self::id($options);
        
        return '<table id="' . $id . '" class="display responsive nowrap" width="100%">'; //  class="display responsive compact"
    }
    
    public static function head($options=[])
    {
        if (isset($options['headCustom'])){
            return $options['headCustom'];
        }
        
        if (!isset($options['headers']))
            return '';
        
        $cnt = '<thead><tr role="row">';
        
        foreach($options['fields'] as $field){
            // style="width: 530.333px;"
            $cnt .= '<th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1">' . $options['headers'][$field] . '</th>';
        }   

        $cnt .= '</tr></thead>';

        return $cnt;
    }
    
    public static function getTrAttr($rowKey, $options=[])
    {
        if (isset($options['trAttr']) && isset($options['trAttr'][$rowKey])){
            return $options['trAttr'][$rowKey];
        }
        
        return '';
    }   
    
    public static function body($options=[])
    {
        $style = isset($options['style']) ? $options['style'] : 'datatable';
        
        $cnt = '<tbody>';
        
        $i = 0;
        
        if (isset($options['data'])){
            foreach($options['data'] as $rowKey => $row){
                
                switch($style){
                case 'datatable':    
                    $attr = ' role="row" class="' . (($i++ % 2) ? 'odd' : 'even') . '"';
                    break;
                default:    
                    $attr = self::getTrAttr($rowKey, $options);
                }
                
                $cnt .= '<tr ' . $attr . '>';
                
                foreach($options['fields'] as $field){
                    $tdAttr = isset($options['tdAttr']) && isset($options['tdAttr'][$field]) ? ' ' . $options['tdAttr'][$field] : '';
                    $cnt .= '<td' . $tdAttr . '>' . (isset($row[$field]) ? $row[$field] : '') . '</td>';    
                }

                $cnt .= '</tr>';
            }    
        }elseif(isset($options['dataRows'])){
            foreach($options['dataRows'] as $row){
                $cnt .= '<tr role="row" class="' . (($i++ % 2) ? 'odd' : 'even') . '">';                
                
                foreach($row as $col){
                    $cnt .= '<td ' . (isset($col['attr']) ? $col['attr'] : '') . '>' . $col['data'] . '</td>';    
                }
                
                $cnt .= '</tr>';
            }
        }   

        $cnt .= '</tbody>';

        return $cnt;
    }

    public static function footer($options=[])
    {
        if (isset($options['tfootContent'])){
            return $options['tfootContent'];
        }
        return '';
    }
    
    public static function bottom($options=[])
    {
        return '</table>';
    }

    public static function js($options=[])
    {
        $id = self::id($options);
        
        return '<script>$(document).ready(()=>{$("#' .  $id . '").DataTable();});</script>';
    }
} 