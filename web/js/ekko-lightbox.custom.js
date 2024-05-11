$(document).delegate('*[data-toggle="lightbox"]',"click",function(event){
    event.preventDefault();
    $("body").addClass("modal-open");
    return $(this).ekkoLightbox({
        alwaysShowClose:true,
        onHide:function(){$("body").removeClass("modal-open");},
        onShown: function() {
            var lightbox = this;
            app.LightboxClose = function(){
                lightbox.close();
            }
        }
    });
});
$(document).on("click",".btnLightboxClose",function(){app.LightboxClose();});
/*
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({});
});
*/