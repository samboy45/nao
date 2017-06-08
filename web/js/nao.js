/**
 * web/js/nao.js
 * Created by firekey on 31/05/2017.
 */

$(function(){
    var bodyElmt = $('body');
    redimensionnerContenuNavigation();
    redimensionnerDiv($('#home-1'));


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    window.addEventListener(
        'resize',
        function()
        {
            redimensionnerContenuNavigation();
            redimensionnerDiv($('#home-1'));
        }
    );


    /* ========================= FONCTIONS ========================= */

    function redimensionnerContenuNavigation()
    {
        var boutonsContenuElmt = $('#bouton-nav>ul>li>a.btn');
        if (bodyElmt.width() < 1040) {
            boutonsContenuElmt.each(
                function()
                {
                    $(this).addClass('btn-xs');
                }
            );
        } else {
            boutonsContenuElmt.each(
                function()
                {
                    $(this).removeClass('btn-xs');
                }
            );
        }
    }

    function redimensionnerDiv(elmt)
    {
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
});