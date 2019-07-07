/**
 * Created by Administrator on 6/8/2015.
 */
(function($) {
    "use strict";
    $(document).ready(function() {
        // Check purchase code ajax
        $('.check-verify').on('click', function(e){
            e.preventDefault();
            var envato_name = $('input[name="user_envato_name"]').val();
            var user_purchase_code = $('input[name="user_purchase_code"]').val();
            var seft = $(this);
            seft.append('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                crossDomain: true,
                data: { 
                    action: 'purchase_code_verify',
                    envato_name: envato_name,
                    user_purchase_code: user_purchase_code,
                },
                success: function(data){
                    $('#check-result').html(data);
                    if($('.vr-message.message-success').length > 0) $('#message').fadeOut();
                    else $('#message').fadeIn();
                    seft.find('i').remove();
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });
            return false;
        });
        //end
        if($('#term-color').length>0){
            $( '#term-color' ).wpColorPicker();
        }
        $('.sv-remove-item').on('click',function () {
            $(this).parent().remove();
            return false;
        });
        $('.sv-button-remove-upload').on('click',function () {
            $(this).parent().find('img').attr('src','');
            $(this).parent().find('input').attr('value','');
            return false;
        });         
        //end

        $('.sv-button-upload').on('click',function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var seff = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
                seff.parent().find('.live-previews').html('<img src="'+attachment.url+'" />');
                seff.parent().find('input.sv-image-value').val(attachment.url);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open();
            return false;
        });

        $('.sv-button-upload-id').on('click',function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var seff = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
                seff.parent().find('.live-previews').html('<img src="'+attachment.url+'" />');
                seff.parent().find('input.sv-image-value').val(attachment.id);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open();
            return false;
        });

        $('.sv-button-remove').on('click',function () {
            var image_df = $(this).parent().find('.live-previews').attr('data-image');
            if(image_df) $(this).parent().find('.live-previews img').attr('src',image_df);
            else $(this).parent().find('.live-previews').html('');
            $(this).parent().find('input.sv-image-value').val('');
            return false;
        });


        $('.sv-button-upload-img').on("click",function(options){
            var default_options = {
                callback:null
            };
            options = $.extend(default_options,options);
            var image_custom_uploader;
            var self = $(this);
            //If the uploader object has already been created, reopen the dialog
            if (image_custom_uploader) {
                image_custom_uploader.open();
                return false;
            }
            //Extend the wp.media object
            image_custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: true
            });
            //When a file is selected, grab the URL and set it as the text field's value
            image_custom_uploader.on('select', function() {
                var selection = image_custom_uploader.state().get('selection');
                var ids = [], urls=[];
                selection.map(function(attachment)
                {
                    attachment  = attachment.toJSON();
                    ids.push(attachment.id);
                    urls.push(attachment.url);

                });
                var img_prev = '';
                for(var i=0;i<urls.length;i++)
                {
                    img_prev += '<img src="'+urls[i]+'" class="img-100">';
                }
                if(img_prev!='')
                    self.parent().find(".img-previews").html(img_prev);
                    self.parent().find("input.multi-image-url").val( JSON.stringify(urls) );


                if (typeof options.callback == 'function'){
                    options.callback({'self':self,'urls':urls});

                };


            });
            image_custom_uploader.open();
            return false;
        });

    });

    $('body').on('click', '.sv-del', function(e)
    {
        e.preventDefault();
        $(this).parent().remove();
    })
})(jQuery);



var acc = document.getElementsByClassName("accordion-metabox");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}