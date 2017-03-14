new WOW().init();
$('.owl-carousel').owlCarousel({
  loop: true,
  margin: 30,
  autoplay: true,
  nav: false,
  dotClass: false,
  autoplayTimeout: 4000,
  responsive: {
    0: { items: 1 },
    600: { items: 3 },
    1000: { items: 4 }
  }
});new WOW().init();
$('.owl-carousel').owlCarousel({
  loop: true,
  margin: 30,
  autoplay: true,
  nav: false,
  dotClass: false,
  autoplayTimeout: 4000,
  responsive: {
    0: { items: 1 },
    600: { items: 3 },
    1000: { items: 4 }
  }
});
function send_email_contact() {
  var option = {
      type: 'POST',
      url: '/user/send',
      dataType: 'json',
      data: $('#frm-contact').serialize(),
      success: function (data) {
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
      }
    };
  $.ajax(option);
}
function check_valid_form(form_name) {
  var valid = true;
  $('#' + form_name + ' .required').each(function () {
    if ($(this).val() == '') {
      valid = false;
      if (!$(this).hasClass('error'))
        $(this).addClass('error');
    } else {
      if ($(this).attr('name') == 'email' && !isValidEmailAddress($(this).val())) {
        valid = false;
        if (!$(this).hasClass('error'))
          $(this).addClass('error');
      } else {
        if ($(this).hasClass('error'))
          $(this).removeClass('error');
      }
    }
  });
  return valid;
}
function isValidEmailAddress(emailAddress) {
  var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
  return pattern.test(emailAddress);
}
;
$(document).ready(function () {
  $('#btn-send-contact').click(function (e) {
    e.preventDefault();
    //check valid
    $is_valid = check_valid_form('frm-contact');
    if ($is_valid) {
      send_email_contact();
    } else {
    }
  });
  //get data to show cart
  var option = {
      type: 'POST',
      url: '/products/getCart',
      dataType: 'json',
      data: $('#frm-book').serialize(),
      success: function (data) {
        if (data !== undefined && data.result != undefined && data.result == 0)
          show_data_cart({});
        else
          show_data_cart(data.data);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
      }
    };
  $.ajax(option);
  //
  if ($('.format-price').length) {
    $.each($('.format-price'), function () {
      var price = $(this).find('input').val();
      $(this).find('strong').text(accounting.format(price, 0));
    });
  }
});
function get_li_item_cart() {
  return '<li class="have-item-cart">' + '<div class="ty-cart-items__list-item-image">' + '<span class="hidden icon-83"></span><span class="babi-icon babi-icon-2"></span><img class="ty-pict" src="{image}" width="60" height="60" alt="{alt}" title="{title}">' + '</div>' + '<div class="ty-cart-items__list-item-desc">' + '<a href="{link-product}">{name}</a>' + '<p>' + '<span>{quantity}</span><span>&nbsp;x&nbsp;</span><span id="" class="none">{price}</span>&nbsp;<span class="none">\u0111</span>' + '</p>' + '</div>' + '<div class="ty-cart-items__list-item-tools cm-cart-item-delete">' + '<a data-ca-dispatch="delete_cart_item" href="" class="cm-ajax cm-ajax-full-render" data-ca-target-id="cart_status*">' + '<i title="Lo\u1ea1i b\u1ecf" class="ty-icon-cancel-circle"></i>' + '</a>' + '</div>' + '</li>';
}
function show_data_cart(data_json) {
  $('#shopping-cart').empty();
  if (jQuery.isEmptyObject(data_json)) {
    $('#shopping-cart .have-item-cart').remove();
    $('#shopping-cart .no-item-cart').removeClass('hide');
    if (!$('#shopping-cart .button-item-cart').hasClass('hide'))
      $('#shopping-cart .button-item-cart').addClass('hide');
    return;
  }
  $('#shopping-cart .no-item-cart').addClass('hide');
  $('#shopping-cart .button-item-cart').removeClass('hide');
  var str = get_li_item_cart();
  var total_item = 0;
  $.each(data_json, function (product_id, arrTotal) {
    if (!jQuery.isEmptyObject(arrTotal))
      $.each(arrTotal, function (color, arrColor) {
        if (!jQuery.isEmptyObject(arrColor))
          $.each(arrColor, function (size, arrSize) {
            var html = str;
            var li = '<li><p>' + arrSize['name'] + ' So luong' + arrSize['quantity'] + '</p></li>';
            html = html.replace('{image}', arrSize['url']);
            html = html.replace('{alt}', '');
            html = html.replace('{title}', '');
            html = html.replace('{name}', arrSize['name']);
            html = html.replace('{quantity}', arrSize['quantity']);
            html = html.replace('{price}', arrSize['price']);
            html = html.replace('{link-product}', arrSize['link']);
            $('#shopping-cart').append(html);
            total_item += parseInt(arrSize['quantity']);
          });
      });
  });
  var str = '<li class="cart-button have-item-cart">' + '<div class="align-right">' + '<a href="/cart" rel="nofollow" class="ty-btn ty-btn__primary pink-color">\u0110\u1eb7t h\xe0ng</a>' + '</div>' + '</li>';
  $('#shopping-cart').append(str);
  $('#menu-cart .badge').html(total_item);
}$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip({ 'html': true });
  $('.list-color img').click(function () {
  });
  $('.list-size span').click(function () {
  });
  $('.total').click(function () {
    if ($('.choice-specify').hasClass('show'))
      $('.choice-specify').removeClass('show');
    else
      $('.choice-specify').addClass('show');
  });
  $('.list-images img').click(function () {
    $('.list-images .select').removeClass('select');
    $(this).addClass('select');
    $('#thumb-img').attr('src', $(this).attr('src'));
    $('#thumb-img').attr('title', $(this).attr('title'));
    $('#thumb-img').attr('title', $(this).attr('title'));
  });
  if (typeof size_by_color !== 'undefined') {
    var color_size = jQuery.parseJSON(size_by_color);
    var url_color = null;
    if (typeof color_image !== 'undefined')
      url_color = jQuery.parseJSON(color_image);
    $('.list-color').html('');
    var first = '';
    $.each(color_size, function (color, size) {
      var html = '<img id="{color}" class="{select}" src="{src}" width="50" height="60" alt="@alt@" title="@alt@">';
      html = html.replace('{color}', color);
      if (first == '') {
        html = html.replace('{select}', 'select');
        first = color;
      } else
        html = html.replace('{select}', '');
      if (url_color && typeof url_color[color] !== 'undefined') {
        var img_color = url_color[color];
        html = html.replace('{src}', img_color['url']);
        html = html.replace(/@alt@/g, img_color['alt']);
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
    $('#myModal').modal('show');
  });
  $('#owl-demo').owlCarousel({
    navigation: true,
    items: 6
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
    if (typeof color_image !== 'undefined')
      url_color = jQuery.parseJSON(color_image);
    if (url_color && typeof url_color[$(this).attr('id')] !== 'undefined' && typeof url_color[$(this).attr('id')]['alt'] !== 'undefined') {
      $('#selected_color').text(url_color[$(this).attr('id')]['alt']);
    }
  });
  registry_click_size();
}
function render_size(color) {
  if (typeof size_by_color !== 'undefined') {
    $('.list-size').html('');
    var size_with_name = null;
    if (typeof size_name !== 'undefined')
      size_with_name = jQuery.parseJSON(size_name);
    var color_size = jQuery.parseJSON(size_by_color);
    if (typeof color_size[color] !== 'undefined') {
      var first = true;
      $.each(color_size[color], function (size, quantity) {
        var html = '<span class="{selected}" id="{size}" title="">{size-name}</span>';
        if (first) {
          html = html.replace('{selected}', 'selected');
          render_quantity(quantity);
        } else
          html = html.replace('{selected}', '');
        html = html.replace('{size}', size);
        html = html.replace('{size-name}', size_with_name[size]);
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
  if (size && color) {
    if (typeof size_by_color !== 'undefined') {
      var color_size = jQuery.parseJSON(size_by_color);
      if (typeof color_size[color] !== 'undefined' && typeof color_size[color][size] !== 'undefined') {
        render_quantity(parseInt(color_size[color][size]));
      }
    }
  }
}
function render_quantity(quantity) {
  $('#cb_quantity').empty();
  for (var i = 1; i <= quantity; i++) {
    $('#cb_quantity').append($('<option></option>').attr('value', i).text(i));
  }
}
function html_item_modal() {
  return '<div class="row">' + '<div class="col-lg-3"><img src="{url}" heigth="60" width="50"></div>' + '<div class="col-lg-6">' + '<p>{name}</p>' + '<p>{color}</p>' + '<p>{size}</p>' + '</div>' + '<div class="col-lg-3">{quantity} x {price}</div></div>';
}
function add_to_cart() {
  //check valid
  if ($('#product-id').val() == '') {
    return;
  }
  if ($('#product-color').val() == '') {
    $('#frm-invalid .modal-body p').html('B\u1ea1n ch\u01b0a ch\u1ecdn m\xe0u');
    $('#frm-invalid').modal('show');
    return;
  }
  if ($('#product-size').val() == '') {
    $('#frm-invalid .modal-body p').html('B\u1ea1n ch\u01b0a ch\u1ecdn size');
    $('#frm-invalid').modal('show');
    return;
  }
  if ($('#cb_quantity').val() == '') {
    $('#frm-invalid .modal-body p').html('B\u1ea1n ch\u01b0a ch\u1ecdn s\u1ed1 l\u01b0\u1ee3ng');
    $('#frm-invalid').modal('show');
    return;
  }
  var option = {
      type: 'POST',
      url: '/products/addCart',
      dataType: 'json',
      data: $('#frm-book').serialize(),
      success: function (data) {
        //data = jQuery.parseJSON(data);
        if (typeof data !== 'undefined' && typeof data.result !== 'undefined' && data.result == 0) {
          if (typeof data.error !== 'undefined') {
            $('#frm-invalid .modal-body p').html(data.error);
            $('#frm-invalid').modal('show');
          }
        } else if (typeof data.result !== 'undefined' && data.result == 1) {
          //success
          var product_id = $('#product-id').val();
          var product_color = $('#product-color').val();
          var product_size = $('#product-size').val();
          var quantity = $('#cb_quantity').val();
          var data_items = data.data;
          var str = '';
          if (typeof data_items[product_id] !== 'undefined' && typeof data_items[product_id][product_color] !== 'undefined' && typeof data_items[product_id][product_color][product_size] !== 'undefined') {
            var arr = data_items[product_id][product_color][product_size];
            str = html_item_modal();
            str = str.replace('{name}', arr['name']);
            str = str.replace('{color}', arr['color']);
            str = str.replace('{size}', arr['size']);
            str = str.replace('{url}', arr['url']);
            str = str.replace('{quantity}', quantity);
            str = str.replace('{price}', arr['price']);
          }
          $('#add-success .modal-body').html(str);
          $('#add-success').modal('show');
          show_data_cart(data_items);
        } else {
          $('#frm-invalid .modal-body p').html('Co loi xay ra');
          $('#frm-invalid').modal('show');
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
      }
    };
  $.ajax(option);
}$(document).ready(function () {
  if (typeof error_text !== 'undefined') {
    $('#popup-error .modal-body p').html(error_text);
    $('#popup-error').modal('show');
  }
  //delete
  $('.icon-delete').click(function () {
    var element = $(this).find('span.id-delete').text();
    if (element) {
      $('#popup-delete-confirm #confirm-id-delete').val(element);
      $('#popup-delete-confirm').modal('show');
    }
  });
  $('#btn-delete').click(function () {
    delete_item();
  });
  $('.row-item').on('mouseover', function () {
    $('#delete-' + $(this).attr('id')).removeClass('hide');
  });
  $('.row-item').on('mouseleave', function () {
    if (!$('#delete-' + $(this).attr('id')).hasClass('hide'))
      $('#delete-' + $(this).attr('id')).addClass('hide');
  });
  //book
  $('#check_out').click(function () {
    //check valid
    if (!check_valid_form('frm-checkout'))
      return;
    $('#frm-checkout').submit();
  });
});
function delete_item() {
  var element = $('#confirm-id-delete').val();
  var option = {
      type: 'POST',
      url: '/checkout/delete',
      dataType: 'json',
      data: 'id_delete=' + element,
      success: function (data) {
        if (typeof data !== 'undefined' && typeof data.result !== 'undefined' && data.result == 1)
          location.reload();
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
      }
    };
  $.ajax(option);
}