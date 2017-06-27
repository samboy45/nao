/**
 * web/js/confirmation.js
 * Créé par firekey le 11/06/2017.
 */

$(function(){

    /* ========================= ACTIONS ========================= */

    redimensionnerDiv($('#confirmation'));
    $('#confirmation').css({paddingTop: '50px'});
    gererIconesFa();


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    $(document).on({
        resize: function(){
            redimensionnerDiv($('#confirmation'));
            gererIconesFa();
        }
    });


    /* ========================= FONCTIONS ========================= */

    function redimensionnerDiv(elmt){
        var largeur = elmt.width();
        if (largeur < 400) {
            elmt.height(1200);
        } else if (largeur >= 400 && largeur < 945) {
            elmt.height(1000);
        } else if (largeur >= 945 && largeur < 1170) {
            elmt.height(800);
        } else {
            elmt.height(largeur*0.5625);
        }
    }

    function gererIconesFa(){
        var largeur = $('html').width();
        if (largeur < 380){
            $('i').hide();
        } else {
            $('i').show();
        }
    }

});