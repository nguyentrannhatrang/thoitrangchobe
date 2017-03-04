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
    
})