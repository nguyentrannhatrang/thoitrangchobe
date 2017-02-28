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
    $('.list-color img').click(function () {
        $('#product-color').val($(this).attr('id'));
        $('.list-color .select').removeClass('select');
        $(this).addClass('select');
    });
    $('.list-size span').click(function () {
        $('#product-size').val($(this).attr('id'));
        $('.list-size .selected').removeClass('selected');
        $(this).addClass('selected');
    });
    
});