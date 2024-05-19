<form action="/system/programupdate/" method="GET"><?php

foreach($program->sections as $section){
    echo controller()->renderPartial('program/form/section',['section'=>$section]);
}

    ?><button type="submit" class="btn btn-primary" data-url="<?= $url ?>">Save</button>
</form>