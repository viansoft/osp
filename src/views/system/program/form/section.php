<?php

$content = '';

foreach($section->options as $option => $value){
    $content .= controller()->renderPartial('program/form/option',['section'=>$section,'option'=>$option,'value'=>$value]);
}

echo inc(
    'box',
    [
        'content' => $content,
        'options' => [
            'title' => $section->name,
        ],
    ]
);