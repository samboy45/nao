/**
 * web/js/qsn.js
 * Créé par firekey le 10/06/2017.
 */

$(function () {

    /* ========================= ACTIONS ========================= */

    setTimeout(function(){
        $('#qsn-2, #qsn-3').hide();
    }, 500);


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    $('#chevron-qsn-1').click(function(){
        $('#qsn-1').slideUp('fast', function(){
            $('#qsn-2').slideDown('fast');
        })
    });

    $('#chevron-qsn-2-haut').click(function(){
        $('#qsn-2').slideUp('fast', function(){
            $('#qsn-1').slideDown('fast');
        })
    });

    $('#chevron-qsn-2-bas').click(function(){
        $('#qsn-2').slideUp('fast', function(){
            $('#qsn-3').slideDown('fast');
        })
    });

    $('#chevron-qsn-3').click(function(){
        $('#qsn-3').slideUp('fast', function(){
            $('#qsn-2').slideDown('fast');
        })
    });

});