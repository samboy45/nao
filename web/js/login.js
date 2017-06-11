/**
 * web/js/login.js
 * Created by firekey on 08/06/2017.
 */

$(function(){
    $('#Inscription main > div')
        .removeAttr('id')
        .addClass('bg-herbe-tropicale');
    $('#Inscription input.btn')
        .removeClass('btn-primary')
        .addClass('btn-pin-glacial text-uppercase blanc');
    retirer($('#Inscription meta'));
    retirer($('#Inscription title'));
    retirer($('#Inscription link'));
    retirer($('#Inscription header'));
    retirer($('#Inscription footer'));


    /* ========================= FONCTIONS ========================= */

    function retirer(elmtTab){
        elmtTab.each(function(){
            $(this).remove();
        })
    }
});