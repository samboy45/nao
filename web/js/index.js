/**
 * web/js/nao.js
 * Créé par firekey le 31/05/2017.
 */

$(function(){

    /* ========================= VARIABLES ========================= */


    /* ========================= ACTIONS POST-LOAD ========================= */

    redimensionnerContenuNavigation();
    redimensionner($('#home-1'));


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    $(window).resize(function(){
        redimensionnerContenuNavigation();
        redimensionner($('#home-1'));
    });


    /* ========================= FONCTIONS ========================= */

    function redimensionnerContenuNavigation(){
        var boutonsContenuElmt = $('#bouton-nav>ul>li>a.btn');
        if ($('#wrapper').width() < 1040) {
            boutonsContenuElmt.each(function(){
                $(this).addClass('btn-xs');
            });
        } else {
            boutonsContenuElmt.each(function(){
                $(this).removeClass('btn-xs');
            });
        }
    }

    function redimensionner(elmt){
        elmt.height(($('#wrapper').height())-15);
    }

});