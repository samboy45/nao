/**
 * web/js/nao.js
 * Created by firekey on 31/05/2017.
 * Last modification on 31/06/2017.
 */

$(function(){
    var bodyElmt = $('body');
    redimensionnerContenuNavigation();
    redimensionnerHome1();


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    window.addEventListener('resize', function() {
        redimensionnerContenuNavigation();
        redimensionnerHome1();
    });


    /* ========================= FONCTIONS ========================= */

    function redimensionnerContenuNavigation() {
        var boutonsContenuElmt = $('#bouton-nav>ul>li>a.btn');
        if (bodyElmt.width() < 1040) {
            boutonsContenuElmt.each(function () {
                $(this).addClass('btn-xs');
            });
        } else {
            boutonsContenuElmt.each(function () {
                $(this).removeClass('btn-xs');
            });
        }
    }

    function redimensionnerHome1() {
        var home1Elmt = $('#home-1');
        var largeur = home1Elmt.width();
        if (largeur < 400) {
            home1Elmt.height(1200);
        } else if (largeur >= 400 && largeur < 945) {
            home1Elmt.height(1000);
        } else if (largeur >= 945 && largeur < 1170) {
            home1Elmt.height(800);
        }

        else {
            home1Elmt.height(largeur*0.5625);
        }

    }
});