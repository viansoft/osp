<?php

use osp\src\models\Program;

$program = new Program();

$read = $program->read();

switch($read['result']){
case 'success':    
    foreach($program->sections as $section){
        echo controller()->renderPartial('program/section',['section'=>$section]);
    }

?><script>
$(document).on('click', '#btnProgramUpdate', function(event){
    $.getJSON('/system/programupdate/?' + $(this).closest("form").serialize(),function(data){
        switch(data.result){
        case "success":
            if (data.message){
                alert(data.message);
            }    
            // app.LightboxClose();
            location.reload();
            break;
        case "error":
            if (data.message){
                alert(data.message);
            }    
            break;
        }    
    });    
    return false;
});
</script><?php
    break;
case 'error':
    echo $read['message'];
    break;    
}    

