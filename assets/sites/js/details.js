$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({'html':true});
    $('.list-color img').click(function(){

    });
    $('.list-size span').click(function(){

    });
    $('.total').click(function () {
        if($('.choice-specify').hasClass('show'))
            $('.choice-specify').removeClass('show');
        else
            $('.choice-specify').addClass('show')
    });
    $('.list-images img').click(function () {
        $('.list-images .select').removeClass('select');
        $(this).addClass('select');
        $('#thumb-img').attr('src',$(this).attr('src'));
        $('#thumb-img').attr('title',$(this).attr('title'));
        $('#thumb-img').attr('title',$(this).attr('title'));
    });

    if(size_by_color !== undefined){
        var color_size = jQuery.parseJSON(size_by_color);
        var url_color = null;
        if(color_image !== undefined)
            url_color = jQuery.parseJSON(color_image);
        $('.list-color').html('');
        var first = '';
        $.each(color_size,function(color,size){
            var html = '<img id="{color}" class="{select}" src="{src}" width="50" height="60" alt="@alt@" title="@alt@">';
            html = html.replace('{color}',color);
            if(first == '') {
                html = html.replace('{select}', 'select');
                first = color;
            }
            else
                html = html.replace('{select}','');
            if(url_color && url_color[color] !== undefined){
                var img_color = url_color[color];
                html = html.replace('{src}',img_color['url']);
                html = html.replace(/@alt@/g,img_color['alt']);
            }
            $('.list-color').append(html);
        });
        //render_size(first);
        registry_click();
        $('.list-color img.select').click();
    }
    $('.list-images img').first().click();
    //add cart
    $('#add-to-cart').click(function (e) {
        e.preventDefault();
        add_to_cart();
        $("#myModal").modal('show');
    });

});
function registry_click_size() {
    $('.list-size span').click(function () {
        $('#product-size').val($(this).attr('id'));
        $('.list-size .selected').removeClass('selected');
        $(this).addClass('selected');
        set_quantity();
        $('#selected_size').text($(this).text());
    });
}
function registry_click() {
    $('.list-color img').click(function () {
        $('#product-color').val($(this).attr('id'));
        $('.list-color .select').removeClass('select');
        $(this).addClass('select');
        render_size($(this).attr('id'));
        var url_color = null;
        if(color_image !== undefined)
            url_color = jQuery.parseJSON(color_image);
        if(url_color && url_color[$(this).attr('id')] !== undefined && url_color[$(this).attr('id')]['alt'] !== undefined){
            $('#selected_color').text(url_color[$(this).attr('id')]['alt']);
        }

    });
    registry_click_size();
}
function render_size(color) {
    if(size_by_color !== undefined) {
        $('.list-size').html('');
        var size_with_name = null;
        if(size_name !== undefined)
            size_with_name = jQuery.parseJSON(size_name);
        var color_size = jQuery.parseJSON(size_by_color);
        if(color_size[color] !== undefined){
            var first = true;
            $.each(color_size[color],function(size,quantity){
                var html = '<span class="{selected}" id="{size}" title="">{size-name}</span>';
                if(first) {
                    html = html.replace('{selected}', 'selected');
                    render_quantity(quantity);
                }
                else
                    html = html.replace('{selected}','');
                html = html.replace('{size}',size);
                html = html.replace('{size-name}',size_with_name[size]);
                $('.list-size').append(html);
                first = false;
            });
        }
    }
    registry_click_size();
    $('.list-size span.selected').click();
}
function set_quantity() {
    var size = $('.list-size .selected').attr('id');
    var color = $('.list-color .select').attr('id');
    if(size && color){
        if(size_by_color !== undefined) {
            var color_size = jQuery.parseJSON(size_by_color);
            if(color_size[color] !== undefined && color_size[color][size] !== undefined ){
                render_quantity(parseInt(color_size[color][size]));
            }
        }
    }
}
function render_quantity(quantity) {
    $('#cb_quantity').empty();
    for(var i= 1; i<=quantity;i++){

        $('#cb_quantity')
            .append($("<option></option>")
                .attr("value",i)
                .text(i));
    }
}

function html_item_modal(){
    return '<div class="row">'+
    '<div class="col-lg-3"><img src="{url}" heigth="60" width="50"></div>'+
                  '<div class="col-lg-6">'+
                    '<p>{name}</p>'+
                    '<p>{color}</p>'+
                    '<p>{size}</p>'+
                  '</div>'+
                  '<div class="col-lg-3">{quantity} x {price}</div></div>';
}
function add_to_cart() {
    //check valid
    if($('#product-id').val() == ''){
        return;
    }
    if($('#product-color').val() == ''){
        $('#frm-invalid .modal-body p').html('Bạn chưa chọn màu');
        $("#frm-invalid").modal('show');
        return;
    }
    if($('#product-size').val() == ''){
        $('#frm-invalid .modal-body p').html('Bạn chưa chọn size');
        $("#frm-invalid").modal('show');
        return;
    }
    if($('#cb_quantity').val() == ''){
        $('#frm-invalid .modal-body p').html('Bạn chưa chọn số lượng');
        $("#frm-invalid").modal('show');
        return;
    }
    var option = {
        type: 'POST',
        url: '/products/addCart',
        dataType: 'json',
        data: $('#frm-book').serialize(),
        success:  function(data) {
            //data = jQuery.parseJSON(data);
            if(data !== undefined && data.result !== undefined && data.result == 0){
                if(data.error !==undefined){
                    $('#frm-invalid .modal-body p').html(data.error);
                    $("#frm-invalid").modal('show');
                }

            }else if(data.result !== undefined && data.result == 1){//success
                var product_id = $('#product-id').val();
                var product_color = $('#product-color').val();
                var product_size = $('#product-size').val();
                var quantity = $('#cb_quantity').val();
                var data_items = data.data;
                var str = '';
                if(data_items[product_id] !== undefined &&
                    data_items[product_id][product_color] !== undefined &&
                    data_items[product_id][product_color][product_size] !== undefined){
                    var arr = data_items[product_id][product_color][product_size];   
                    str = html_item_modal();
                    str = str.replace('{name}',arr['name']);     
                    str = str.replace('{color}',arr['color']);                 
                    str = str.replace('{size}',arr['size']);                 
                    str = str.replace('{url}',arr['url']);
                    str = str.replace('{quantity}',quantity);
                    str = str.replace('{price}',arr['price']);                                             

                }
                $('#add-success .modal-body').html(str);
                $('#add-success').modal('show');
                show_data_cart(data_items);
            }else{
                $('#frm-invalid .modal-body p').html('Co loi xay ra');
                $("#frm-invalid").modal('show');
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
    
}