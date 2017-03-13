
$(document).ready(function(){
    $('.edit-item').click(function (e) {
        e.preventDefault();
        $("#frm-edit").modal('show');
        edit($(this).attr('data-item'));
    });
    $('#btn-save-item').click(function () {
        //check data
        save_item();
    });
        
    

});
function save_item() {
    var option = {
        type: 'POST',
        url: '/admin/order/saveItem',
        dataType: 'json',
        data: $('#frm-edit').serialize(),
        success:  function(data) {
            if(typeof data !== 'undefined' && typeof data.result !== 'undefined' && data.result ==1){
                //view booking
                
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
        url: '/admin/order/editItem',
        dataType: 'json',
        data: 'bkId='+bkId,
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
                    $('#price').val(data.price);
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
    };
    $.ajax(option);
}