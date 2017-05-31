/**
 * web/js/nao.js
 * Created by firekey on 31/05/2017.
 * Last modification on 31/06/2017.
 */

$(function(){
    var bodyElmt = $('body');
    redimensionnerContenuNavigation();


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    window.addEventListener('resize', function() {
        redimensionnerContenuNavigation();
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
});