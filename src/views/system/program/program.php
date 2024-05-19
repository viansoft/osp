<?php

use osp\src\models\Program;

$program = new Program();

$read = $program->read();

switch($read['result']){
case 'success':    
    foreach($program->sections as $section){
        echo controller()->renderPartial('program/section',['section'=>$section]);
    }

?><?php
    break;
case 'error':
    echo $read['message'];
    break;    
}    

