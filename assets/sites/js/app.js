new WOW().init();
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    autoplay: true,
    nav: false,
    dotClass: false,
    autoplayTimeout: 4000,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
});
function send_email_contact(){
    var option = {
        type: 'POST',
        url: '/user/send',
        dataType: 'json',
        data: $('#frm-contact').serialize(),
        success:  function(data) {

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
}
function check_valid_form(form_name) {
    var valid = true;
    $('#'+form_name+' .required').each(function () {
        if($(this).val() == ''){
            valid = false;
            if(!$(this).hasClass('error'))
                $(this).addClass('error');
        }else{
            if($(this).attr('name') == 'email' && !isValidEmailAddress($(this).val())){
                valid = false;
            if(!$(this).hasClass('error'))
                $(this).addClass('error');
            }else{
                if($(this).hasClass('error'))
                $(this).removeClass('error');
            }
        }
    });
    return valid;
}
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

$(document).ready(function(){
  $('#btn-send-contact').click(function (e) {
      e.preventDefault();
      //check valid
      $is_valid = check_valid_form('frm-contact');
      if($is_valid){
          send_email_contact();
      }else{

      }
  });
    //get data to show cart
    var option = {
        type: 'POST',
        url: '/products/getCart',
        dataType: 'json',
        data: $('#frm-book').serialize(),
        success:  function(data) {
            if(data !== undefined && data.result != undefined && data.result == 0)
                show_data_cart({});
            else
                show_data_cart(data.data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
    //
    if($('.format-price').length){
        $.each($('.format-price'),function(){
            var price = $(this).find('input').val();
            $(this).find('strong').text(accounting.format(price,0));
        });
    }
});
function get_li_item_cart(){
    return '<li class="have-item-cart">'+
                            '<div class="ty-cart-items__list-item-image">'+
                                '<span class="hidden icon-83"></span><span class="babi-icon babi-icon-2"></span><img class="ty-pict" src="{image}" width="60" height="60" alt="{alt}" title="{title}">'+
                            '</div>'+
                            '<div class="ty-cart-items__list-item-desc">'+
                                '<a href="{link-product}">{name}</a>'+
                                '<p>'+
                                    '<span>{quantity}</span><span>&nbsp;x&nbsp;</span><span id="" class="none">{price}</span>&nbsp;<span class="none">đ</span>'+
                                '</p>'+
                            '</div>'+
                            '<div class="ty-cart-items__list-item-tools cm-cart-item-delete">'+
                                '<a data-ca-dispatch="delete_cart_item" href="" class="cm-ajax cm-ajax-full-render" data-ca-target-id="cart_status*">'+
                                    '<i title="Loại bỏ" class="ty-icon-cancel-circle"></i>'+
                                '</a>'+
                            '</div>'+
                        '</li>';
}
function show_data_cart(data_json) {
    $('#shopping-cart').empty();
    if(jQuery.isEmptyObject(data_json)){
        $('#shopping-cart .have-item-cart').remove();
        $('#shopping-cart .no-item-cart').removeClass('hide');
        if(!$('#shopping-cart .button-item-cart').hasClass('hide'))
            $('#shopping-cart .button-item-cart').addClass('hide');
        return;
    }
    $('#shopping-cart .no-item-cart').addClass('hide');
    $('#shopping-cart .button-item-cart').removeClass('hide');

    var str = get_li_item_cart();
    var total_item = 0;
    $.each(data_json,function (product_id,arrTotal) {
        if(!jQuery.isEmptyObject(arrTotal))
            $.each(arrTotal,function (color,arrColor) {
                if(!jQuery.isEmptyObject(arrColor))
                $.each(arrColor,function (size,arrSize) {
                    var html = str;
                    var li = '<li><p>'+ arrSize['name']+ ' So luong'+arrSize['quantity']+'</p></li>';
                    html = html.replace('{image}',arrSize['url']);
                    html = html.replace('{alt}','');
                    html = html.replace('{title}','');
                    html = html.replace('{name}',arrSize['name']);
                    html = html.replace('{quantity}',arrSize['quantity']);
                    html = html.replace('{price}',arrSize['price']);
                    html = html.replace('{link-product}',arrSize['link']);
                    $('#shopping-cart').append(html);
                    total_item += arrSize['quantity'];
                });

            });
    });
    var str ='<li class="cart-button have-item-cart">'+
                '<div class="align-right">'+
                    '<a href="/cart" rel="nofollow" class="ty-btn ty-btn__primary pink-color">Đặt hàng</a>'+
                '</div>'+
            '</li>';
    $('#shopping-cart').append(str);
    $('#menu-cart .badge').html(total_item);
}