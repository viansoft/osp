<?php

$contents = [];
foreach($section->options as $name => $value){
    $contents[] = $name . ': ' . $value;  
}

echo inc(
    'box',
    [
        'content' => implode('<br>',$contents),
        'options' => [
            'title' => $section->name,
        ],    
    ]
);