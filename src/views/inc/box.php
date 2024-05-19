<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline"><?php
        
            $title = isset($options['title']) ? $options['title'] : '';
            $tools = isset($options['tools']) ? $options['tools'] : '';
            
            if ($title || $tools){

                ?><div class="card-header"><?php
        
                if ($title){
                    ?><h5 class="card-title m-0"><?= $title ?></h5><?php
                }    
                
                if ($tools){
                    ?><div class="card-tools"><?= $tools ?></div><?php
                }    
            
                ?></div><?php
            }
            
            ?><div class="card-body"><?= $content ?></div>
        </div>
    </div>
</div>