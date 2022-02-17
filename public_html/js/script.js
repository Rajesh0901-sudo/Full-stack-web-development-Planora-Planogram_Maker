jQuery("body").prepend('<div id="preloader"><center>Loading....<center></div>');

$(document).ready(function () {
    jQuery("#preloader").remove();
    $("#bin1").show();
    $("#bin2").hide();
    $("#bin3").hide();
    
    $('#b1').click(function () {
        $('#bin1').show();
        $('#bin2').hide();
        $('#bin3').hide();
        /* border bottom on button click */
        $('#b1').css({ 'border-bottom': '2px solid rgb(85, 83, 83)' });
        /* remove border after click */
        $('#b2').css({ 'border-style': 'none' });
        $('#b3').css({ 'border-style': 'none' });
    });
    $('#b2').click(function () {
        $('#bin2').show();
        $('#bin1').hide();
        $('#bin3').hide();
        /* border bottom on button click */
        $('#b2').css({ 'border-bottom': '2px solid rgb(85, 83, 83)' });
        /* remove border after click */
        $('#b1').css({ 'border-style': 'none' });
        $('#b3').css({ 'border-style': 'none' });
    });
    $('#b3').click(function () {
        $("#bin3").show();
        $("#bin2").hide();
        $('#bin1').hide();
        /* border bottom on button click */
        $('#b3').css({ 'border-bottom': '2px solid rgb(85, 83, 83)' });
        /* remove border after click */
        $('#b2').css({ 'border-style': 'none' });
        $('#b1').css({ 'border-style': 'none' });
    });
    var max_width = $('.Wall').width() - 100;
    var max_height = $('.Wall').height() - 100;
    $('.DrawingArea').resizable({
        maxWidth:1600,
        maxHeight:2300
    });
    $('.DrawingArea').resize(function () {
         max_width = $('.Wall').width() - 100;
         max_height = $('.Wall').height() - 100;
    });
    
    $('.btn').click(function (event, ui) {
        var element = $(this).children().clone();
        max_width = $('.Wall').width() - 100;
        max_height = $('.Wall').height()-100;
        $('.Wall').prepend(element.addClass('Wall_Element').removeClass('item').removeClass('btn').removeClass('butt'));
        $('.Wall').children().resizable({
            maxWidth:max_width,
            maxHeight:max_height
        });
        $('.Wall').children().draggable({ containment: '.Wall'});
        
        $('.Wall').children().dblclick(function(){
            $(this).detach();
        });
        
    });
    
    $('.logo').click(function () {
        $('.DrawingArea').printThis();
    });
    $('.save').click(function () {
        $('.DrawingArea').printThis();
    });
    $('.export').click(function () {
        $('.DrawingArea').printThis();
    });
    

});





