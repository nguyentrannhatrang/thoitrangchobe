$(document).ready(function(){
    if(typeof error_text !== 'undefined'){
        $('#popup-error .modal-body p').html(error_text);
        $("#popup-error").modal('show');
    }
    //delete
    $('.icon-delete').click(function () {
        var element = $(this).find('span.id-delete').text();
        if(element){
            $("#popup-delete-confirm #confirm-id-delete").val(element);
            $("#popup-delete-confirm").modal('show');
        }
    });
    $('#btn-delete').click(function () {
        delete_item();
    });
    $('.row-item').on('mouseover', function () {
        $('#delete-'+$(this).attr('id')).removeClass('hide');
    });
    $('.row-item').on('mouseleave', function () {
        if(!$('#delete-'+$(this).attr('id')).hasClass('hide'))
            $('#delete-'+$(this).attr('id')).addClass('hide');
    });
    //book
    $('#check_out').click(function () {
        //check valid
        if(!check_valid_form('frm-checkout'))
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
        data: 'id_delete='+element,
        success:  function(data) {
            if(typeof data !== 'undefined' && typeof data.result !== 'undefined' && data.result ==1)
                location.reload();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
}