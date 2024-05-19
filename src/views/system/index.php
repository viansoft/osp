<?php

echo inc(
    'box', 
    [
        'content' => controller()->renderPartial('program/program'),
        'options' => [
            'title'=>'program.ini <a href="https://github.com/OSPanel/OpenServerPanel/wiki/%D0%94%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82%D0%B0%D1%86%D0%B8%D1%8F#%D0%BD%D0%B0%D1%81%D1%82%D1%80%D0%BE%D0%B9%D0%BA%D0%B0-%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D1%8B" target="_blank">[help]</a>',
            // 'tools' => '<a href="/system/programupdate/" class="btn btn-primary" data-width="800" data-title="Update program.ini" data-toggle="lightbox">Update</a>'
            'tools' => '<a href="/system/programupdate/" class="btn btn-primary">Update</a>'
            
        ],
    ]
);