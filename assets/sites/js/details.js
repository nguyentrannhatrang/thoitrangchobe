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
});