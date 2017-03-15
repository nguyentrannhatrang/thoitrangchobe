
$(document).ready(function(){

    $(document).on('click','.edit-item',function (e) {
        e.preventDefault();
        $("#frm-edit").modal('show');
        edit($(this).attr('data-item'));
    });
    $('#add-item').click(function (e) {
        e.preventDefault();
        $("#frm-edit").modal('show');
    });
    $('#btn-save-item').click(function () {
        //check data
        save_item();
    });
    $('#btn-close').click(function (e) {
        e.preventDefault();
        location.href = '/admin/orders';
    });
    //save booking
    $('#btn-save').click(function (e) {
        e.preventDefault();
       //save booking
        save_booking();
    });
    $.extend($.fn.autoNumeric.defaults, {
        aSep: '.',
        aDec: ','
    });
    $('.auto-number').autoNumeric('init', {aSign:' VND', pSign:'s' });

});
function save_booking() {
    var option = {
        type: 'POST',
        url: '/admin/order/save',
        dataType: 'json',
        data: $('#frm-booking').serialize(),
        success:  function(data) {
            if(typeof data !== 'undefined' && typeof data.result !== 'undefined' && data.result ==1){
                //view booking
                location.href = '/admin/orders';
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
}
function getHtmlItem() {
    return '<tr class="alert-success">'+
    '<td>'+
    '{id}'+
    '</td>'+
    '<td>{product-name}</td>'+
    '<td>{color}</td>'+
    '<td>{size}</td>'+
    '<td>'+
    '{quantity}'+
'</td>'+
    '<td>{status}</td>'+
    '<td class="auto-number">{total}</td>'+
    '<td>'+
    '<a href="#" class="edit-item" data-item="{id}">Edit</a>'+
        '</td>'+
        '</tr>';
}
function save_item() {
    $('#price-org').val( $('#price').autoNumeric('get'));
    var option = {
        type: 'POST',
        url: '/admin/order/saveItem',
        dataType: 'json',
        data: $('#frm-edit-item').serialize(),
        success:  function(data) {
            if(typeof data !== 'undefined' && typeof data.result !== 'undefined' && data.result ==1){
                //view booking
                data = data.data;
                if(data.booking){
                    $('#total-booking').autoNumeric('set',data.booking.total);
                }
                if(data.items){
                    $('#list-items').empty();
                    var a_color = jQuery.parseJSON( arr_color );
                    var a_size = jQuery.parseJSON( arr_size );
                    var a_status = jQuery.parseJSON( arr_status );

                    $.each(data.items,function (index,item) {
                        var html = getHtmlItem();
                        html = html.replace(/{id}/g,item.id);
                        html = html.replace('{product-name}',item.product_name);
                        html = html.replace('{quantity}',item.quantity);
                        html = html.replace('{total}',item.total);
                        html = html.replace('{color}',a_color[item.color]);
                        html = html.replace('{size}',a_size[item.size]);
                        html = html.replace('{status}',a_status[item.status]);
                        $('#list-items').append(html);
                    })
                    $('#list-items .auto-number').autoNumeric('init', {aSign:' VND', pSign:'s' });
                }
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
}

function edit(bkId) {
    var option = {
        type: 'GET',
        url: '/admin/order/editItem?bkId='+bkId,
        dataType: 'json',
        success:  function(data) {
            if(typeof data !== 'undefined' && typeof data.result !== 'undefined' && data.result ==1){
                data = data.data;
                if(typeof data.id != 'undefined' && data.id)
                    $('#item_id').val(data.id);
                if(typeof data.product != 'undefined' && data.product)
                    $('#product').val(data.product);
                if(typeof data.color != 'undefined' && data.color)
                    $('#color').val(data.color);
                if(typeof data.size != 'undefined' && data.size)
                    $('#size').val(data.size);
                if(typeof data.quantity != 'undefined' && data.quantity)
                    $('#quantity').val(data.quantity);
                if(typeof data.status != 'undefined' && data.status)
                    $('#status').val(data.status);
                if(typeof data.price != 'undefined' && data.price)
                    $('#price').autoNumeric('set',data.price);
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
}