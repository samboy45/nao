/**
 * web/js/mon-compte.js
 * Créé par firekey le 10/06/2017.
 */

$(function(){

    /* ========================= VARIABLES ========================= */


    /* ========================= ACTIONS POST-LOAD ========================= */

    retirer($('#show meta, #show link, #show title, #show header, #show footer, #show script'));
    retirer($('#my-observations meta, #my-observations link, #my-observations title, #my-observations header, #my-observations footer, #my-observations script'));

    $(':input').addClass('pin-glacial');
    $('#form_recherche').parent().css({marginTop: '20px'});

    $('#admin').hide();

    organiserContenu();

    $('#nombre span').text($('#nb-obs').val());
    $('#validees span').text($('#nb-val').val());
    $('#attente span').text($('#nb-att').val());

    setTimeout(function(){
        selectionnerTab($('#nombre'));
        $('#nombre').removeClass('aloe-vera').addClass('pin-glacial');
        montrerDiv($('#tabNombre'));
        $('#ajouter').removeClass('pin-glacial');
    }, 50);


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    $(window).resize(function(){
        organiserContenu();
    });

    $('#nombre').on('click', function(){
        deselectionnerTabs();
        selectionnerTab($(this));
        cacherDiv($('#tabValidees, #tabAttente'));
        setTimeout(function(){
            montrerDiv($('#tabNombre'));
        }, 300);

    });

    $('#validees').on('click', function(){
        deselectionnerTabs();
        selectionnerTab($(this));
        cacherDiv($('#tabNombre, #tabAttente'));
        setTimeout(function(){
            montrerDiv($('#tabValidees'));
        }, 300);
    });

    $('#attente').on('click', function(){
        deselectionnerTabs();
        selectionnerTab($(this));
        cacherDiv($('#tabValidees, #tabNombre'));
        setTimeout(function(){
            montrerDiv($('#tabAttente'));
        }, 300);
    });

    $('#btn-admin').on('click', function(){
        deselectionnerTabs();
        desactiverElmts($('#btn-admin, #nombre, #validees, #attente'));
        cacherDiv($('#my-observations'));
        setTimeout(function(){
            montrerDiv($('#admin'));
        }, 300);
    });

    $('#croix-admin').on('click', function(){
        activerElmts($('#btn-admin, #nombre, #validees, #attente'));
        selectionnerTab($('#nombre'));
        $('#tabValidees, #tabAttente').hide();
        $('#tabNombre').show();
        cacherDiv($('#admin'));
        setTimeout(function(){
            montrerDiv($('#my-observations'));
        }, 300);
    });

    $('#relais-form-recherche').on('click', function(){
        $('#valider-form-recherche').click();
    });

    $('#relais-form-roles').on('click', function(){
        $('#valider-form-roles').click();
    });


    /* ========================= FONCTIONS ========================= */

    function retirer(elmtTab){
        elmtTab.each(function(){
            $(this).remove();
        });
    }

    function organiserContenu(){
        if ($(window).width() >= 751){
            $('#image').removeClass('col-xs-6 col-xs-offset-3').addClass('col-xs-8 col-xs-offset-2');
        } else {
            $('#image').removeClass('col-xs-8 col-xs-offset-2').addClass('col-xs-6 col-xs-offset-3');
        }
        $('#my-observations').height($('#show').height());
        $('#admin, #admin > div').height($('#show').height());
    }

    function selectionnerTab(elmt){
        elmt.parent().toggleClass('bg-pin-glacial aloe-vera bg-aloe-vera pin-glacial');
        elmt.toggleClass('aloe-vera pin-glacial');
        elmt.children().toggleClass('bg-aloe-vera pin-glacial bg-pin-glacial aloe-vera');
        desactiverElmts(elmt);
    }

    function deselectionnerTabs(){
        $('#div-nombre, #div-validees, #div-attente').removeClass('bg-aloe-vera pin-glacial').addClass('bg-pin-glacial aloe-vera');
        $('#nombre, #validees, #attente').removeClass('pin-glacial').addClass('aloe-vera');
        $('#nombre span, #validees span, #attente span').removeClass('bg-pin-glacial aloe-vera').addClass('bg-aloe-vera pin-glacial');
        activerElmts($('#nombre, #validees, #attente'));
    }

    function desactiverElmts(elmts){
        elmts.each(function(){
            $(this).attr('disabled', 'disabled');
        });
    }

    function activerElmts(elmts){
        elmts.each(function(){
            $(this).removeAttr('disabled');
        });
    }

    function cacherDiv(elmts){
        $(elmts).each(function(){
            $(this).hide('slide', {direction: 'left'}, 200);
        });
    }

    function montrerDiv(elmt){
        $(elmt).show('slide', {direction: 'left'}, 200);
    }
});