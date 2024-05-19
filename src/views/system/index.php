<?php

echo inc(
    'box', 
    [
        'content' => controller()->renderPartial('program/program'),
        'options' => [
            'title'=>'program.ini',
            'tools' => '<a href="/system/programupdate/" class="btn btn-primary" data-width="800" data-title="Update program.ini" data-toggle="lightbox">Update</a>'
        ],
    ]
);