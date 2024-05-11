<form action="#">
    <h5>Select directory where you want to create new project:</h5><?php
    
        ?><select name="project"><?php
        
        $reader = new osp\src\components\OspReader(app()->dir('projects'));    
        
        $reader->readProjects();
        
        foreach($reader->empty as $val){
            ?><option value="<?= $val ?>"><?= $val ?></option><?php
        }
        
        ?></select><?php

    ?><hr><button type="button" class="btn btn-primary" id="btnCreate" data-url="<?= $url ?>">Create</button>
    <a id="linkUpdate" href="#" data-width="800" data-title="" data-toggle="lightbox"></a>
</form><br>
