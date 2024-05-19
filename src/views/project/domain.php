<label>Domain:</label><input type="text" name="domain[<?= $num ?>][name]" value="<?= $domain->name; ?>"><?php

$fields = $domain->fields();

foreach($domain->options as $option => $value){
    ?><br><label><?= $option ?>:</label><?php
    
    $attributes = $fields[$option];
    
    switch($attributes['type']){
    case 'select':
        ?><select name="domain[<?= $num ?>][<?= $option ?>]"><?php
        
        foreach($attributes['items'] as $val => $title){
            ?><option value="<?= $val ?>" <?= ($value == $val ? 'selected' : '') ?>><?= $title ?></option><?php
        }
        
        ?></select><?php
        break;
    case 'text':    
    default:
        ?><input type="text" name="domain[<?= $num ?>][<?= $option ?>]" value="<?= $value; ?>"><?php
        break;
    }
    
}

?><hr>
