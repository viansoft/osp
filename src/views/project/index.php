<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Projects</h5>
                <div class="card-tools">
                    <a href="/project/create/" class="btn btn-primary" data-width="800" data-title="New project" data-toggle="lightbox">New project</a>
                </div>
            </div>
            <div class="card-body"><?= controller()::table(); ?></div>
        </div>
    </div>
</div><script>
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
