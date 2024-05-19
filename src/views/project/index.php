<?php

$options = [
    'title' => 'List of projects',
    'tools' => '<a href="/project/create/" class="btn btn-primary" data-width="800" data-title="New project" data-toggle="lightbox">New project</a>',
];

echo inc(
    'box', 
    [
        'content' => controller()::table(),
        'options' => $options
    ]
);

?><script>
$(document).on('click', '#btnUpdate', function(event){
    $.getJSON($(this).data('url') + $(this).closest("form").serialize(),function(data){
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

$(document).on('click', '#btnCreate', function(event){
    $.getJSON('/project/create/?' + $(this).closest("form").serialize(),function(data){
        switch(data.result){
        case "success":
            app.LightboxClose();
            let link = $("#linkUpdate")
            link.attr('href','/project/update/?project=' + data.project);
            link.attr('data-title',data.project);
            link.trigger('click');   
            // location.reload();
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
</script>