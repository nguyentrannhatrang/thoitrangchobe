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
            if($(this).hasClass('error'))
                $(this).removeClass('error');
        }
    });
    return valid;
}

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
})