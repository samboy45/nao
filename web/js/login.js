/**
 * web/js/login.js
 * Créé par firekey le 08/06/2017.
 */

$(function(){

    /* ========================= VARIABLES ========================= */


    /* ========================= ACTIONS POST-LOAD========================= */

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
    redimensionner($('#login-1'));


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    $(window).resize(function(){
        redimensionner($('#login-1'));
    });


    /* ========================= FONCTIONS ========================= */

    function redimensionner(elmts){
        elmts.each(function(){
            $(this).height($('#wrapper').height()-15);
        });
    }

    function retirer(elmtTab){
        elmtTab.each(function(){
            $(this).remove();
        })
    }

});