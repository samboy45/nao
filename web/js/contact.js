/**
 * web/js/contact.js
 * Created by firekey on 08/06/2017.
 */

$(function () {
    $('#contact-form form')
        .addClass('bg-herbe-tropicale')
        .css('border-radius', '30px 30px 0 0');
    $('form > div')
        .addClass('bg-herbe-tropicale')
        .css('margin-bottom', '0')
        .css('padding-bottom', '15px');
    $('form > div:nth-child(8)').css('border-radius', '0 0 30px 30px');
    $(':submit')
        .removeClass('btn-primary')
        .addClass('btn-pin-glacial text-uppercase blanc btn-block');
});