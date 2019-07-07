(function($)
{
	"use strict";
    //Show Image
    $('.s7up_image_check').each(function () {
        if($(this).closest('.vc_ui-panel-window-inner').length > 0){
            var t = $(this);
            var el = $(this).data('element');
            var param_name = $(this).data('param_name');
            var img_url = $(this).data('img_url');
            $('select.'+el).closest('.wpb_el_type_dropdown').addClass('has-show-image');
            $('.wpb_el_type_dropdown select.'+el).change(function() {
                var selected = $(this).find('option:selected').val();
                var link = img_url + param_name+'/'+selected+'.jpg';
                t.find('img').attr('src',link);

            });
            var src = $(this).find('.image_icon_mb').attr('src');
            var $html = '<div class="modal"><h3 class="title">Demo</h3><img class="modal-content" src = "'+src+'"></div>';
            $(this).append($html);
        }
    });
	$('.vc_ui-button-action[data-vc-ui-element=button-save]').on('click', function()
    {
    	var value;
        if($('.st_add_location').length >0) {
            var value = $('.st_add_location').find('.st-location-save').serialize();
            $('.st-location-value').val( encodeURIComponent(value) );
        }        
        $('.wrap-param').each(function(){
            value = $(this).find('.param-list').find('.param-field').serialize();
            $(this).find('.param-value').val( encodeURIComponent(value) ); 
        })
    });
    // maps location
    var set_first = 1;
    $('.st-location-add-map').on('click', function()
    {
        var key = $('.st_add_location').find('.location-item').last().attr('data-item');
        // console.log('sss');
        if(key == '' || key == undefined)
        {
            key = set_first;
            set_first++;
        }else
        {
            key = parseInt(key) + 1;
        }
        var item = '<div class="location-item" data-item="'+key+'">';
            item += '<div class="wpb_element_label">Location '+key+'</div>';
            item += '<label>Latitude</label><input class="st-input st-location-save st-title" name="'+key+'[lat]" value="" type="text">';
            item += '<label>Longitude</label><input class="st-input st-location-save st-des" name="'+key+'[lon]" value="" type="text">';
            item += '<label>Marker Title</label><input class="st-input st-location-save st-label" name="'+key+'[title]" value="" type="text">';
            item += '<label>Info Box</label><textarea class="st-input st-location-save info-content" name="'+key+'[boxinfo]"></textarea>';
            item += '</span>';
            item += '<a href="#" class="st-del-item">delete</a>';
            item += '</div>';
        $('.st_add_location').append(item);
        $('.st_add_location').find('.location-item').last().attr('data-item',key);
    });
    // add param
    $('.add-param').on('click', function()
    {
        var seff = $(this).parents('.wrap-param').find('.param-list');
        var key = seff.find('.param-item').last().data('item');
        if(key == '' || key == undefined) key = 1;
        else key = parseInt(key) + 1;
        var item = $(this).next().html();
        item = item.replace(/#key/g, key);
        seff.append(item);
    });
    // Delete
    $('body').on('click', '.st-del-item', function(e)
    {
        e.preventDefault();
        $(this).parent().remove();
    })

})(jQuery)