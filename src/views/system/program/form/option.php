<?php
    $name = 'section[' . $section->name . '][' . $option . ']';
    
    ?><br><label><?= $option ?>:</label><?php
    
    if (in_array($value,['on','off'])){
        $type = 'select';
        $items = [
            'on' => 'on',
            'off' => 'off'
        ];
    }else{
        $type = 'text';
    }
 
    switch($type){
    case 'select':
        ?><select name="<?= $name ?>"><?php
        
        foreach($items as $val => $title){
            ?><option value="<?= $val ?>" <?= ($value == $val ? 'selected' : '') ?>><?= $title ?></option><?php
        }
        
        ?></select><?php
        break;
    case 'text':    
    default:
        ?><input type="text" name="<?= $name ?>" value="<?= $value; ?>"><?php
        break;
    }