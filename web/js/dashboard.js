/**
 * web/js/dashboard.js
 * Créé par firekey le 23/06/2017.
 */

$(function(){

    /* ========================= VARIABLES ========================= */

    var liste = $('#users-list').text().split(' ');
    var sources = [];
    for (i = 0; i < liste.length; i ++){
        if (liste[i].length > 1){
            sources.push(liste[i]);
        }
    }

    /* ========================= ACTIONS POST-LOAD ========================= */

    $('.btn-nav').removeClass('active');
    $('#btn-nav-cpt').addClass('active');

    $('#creer-user, #btn-admin').hide();

    $('#form_recherche').autocomplete({
        source : sources,
        select : function(){
            $('#valider-form-recherche').trigger('click');
        }
    });

    $('#form_roles').on({
        change: function(){
            $('#valider-form-roles').trigger('click');
        }
    });



    /* ========================= GESTION EVENEMENTIELLE ========================= */

    $('#ajouter').on({
        click: function(){
            cacherDiv($('#liste-users'));
            setTimeout(function(){
                montrerDiv($('#creer-user'));
            }, 500);
        }
    });

    $('#retrait').on({
        click: function(){
            cacherDiv($('#creer-user'));
            setTimeout(function(){
                montrerDiv($('#liste-users'));
            }, 500);
        }
    });


    /* ========================= FONCTIONS ========================= */

    function cacherDiv(elmts){
        $(elmts).each(function(){
            $(this).hide('slide', {direction: 'left'}, 400);
        });
    }

    function montrerDiv(elmt){
        $(elmt).show('slide', {direction: 'left'}, 400);
        redimensionner($('html'));
    }

    function redimensionner(elmts){
        $(elmts).each(function(){
            $(this).css('min-height', $('.container-fluid').height()+$('.navbar-fixed-top').height() + 30);
        });
    }

});