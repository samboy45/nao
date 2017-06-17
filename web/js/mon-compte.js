/**
 * web/js/mon-compte.js
 * Créé par firekey le 10/06/2017.
 */

$(function () {

    /* ========================= VARIABLES ========================= */

    var divTabActive = $('#div-nombre');


    /* ========================= ACTIONS POST-LOAD ========================= */

    retirer($('#show meta, #show link, #show title, #show header, #show footer, #show script'));
    retirer($('#my-observations meta, #my-observations link, #my-observations title, #my-observations header, #my-observations footer, #my-observations script'));

    $('#admin').css({paddingLeft: '0'}).hide();
    $('#admin > div:first-child').css({paddingLeft: '0', paddingRight: '0'});
    $('#admin > div:last-child').css({paddingRight: '0', overflow: 'auto'});
    $('#admin-index').css({overflow: 'auto'});

    $('#show').css({padding: '0', borderBottom: '1px solid rgba(40, 204, 158, 1)'});
    $('#nombre, #validees, #attente, #ajouter').height('50px');
    $('#div-nombre, #div-validees').css({borderBottom: '1px solid rgba(203, 247, 211, 1)'});

    $('.badge, #ajouter i').css({marginRight: '10px'});

    organiserContenu();

    $('#div-ajouter').css({position: 'absolute', bottom: '0'});

    $('#nombre span').text($('#nb-obs').val());
    $('#validees span').text($('#nb-val').val());
    $('#attente span').text($('#nb-att').val());

    $('#form_recherche').parent().css({marginTop: '20px'});

    setTimeout(function(){
        montrerDiv($('#nombre'));
        $('#ajouter').removeClass('pin-glacial');
    }, 50);

    $(':input').addClass('pin-glacial');


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    $(window).resize(function(){
        organiserContenu();
    });

    $('#nombre').on('click', function(){
        montrerDiv($(this));
    });

    $('#validees').on('click', function(){
        deselectionnerTabs();
        selectionnerTab($(this));
        $('#tabNombre, #tabAttente').hide('slide', {direction: 'left'}, function(){
            $('#tabValidees').show('slide', {direction: 'left'});
        });
    });

    $('#attente').on('click', function(){
        deselectionnerTabs();
        selectionnerTab($(this));
        $('#tabNombre, #tabValidees').hide('slide', {direction: 'left'}, function(){
            $('#tabAttente').show('slide', {direction: 'left'});
        });
    });

    $('#btn-admin').on('click', function(){
        deselectionnerTabs();
        desactiverElmts($('#btn-admin, #nombre, #validees, #attente'));
        $('#my-observations').hide('slide', {direction: 'left'}, function(){
            $('#admin').show('slide', {direction: 'left'});
        });
    });

    $('#croix-admin').on('click', function(){
        activerElmts($('#btn-admin, #nombre, #validees, #attente'));
        $('#admin').hide('slide', {direction: 'left'}, function(){
            $('#nombre').click();
            $('#my-observations').show('slide', {direction: 'left'});
        });
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
        $('#fos-profil-show main > div').css({background: 'none', minHeight: '0'});
        if ($(window).width() >= 751){
            $('#div-mon-compte').css({padding: '50px'});
            $('#image').removeClass('col-xs-6 col-xs-offset-3').addClass('col-xs-8 col-xs-offset-2');
            $('#admin > div:first-child').css({borderRight: '1px solid rgba(25, 107, 105, 1)', borderBottom:'none'});
        } else {
            $('#div-mon-compte').css({padding: '0'});
            $('#image').removeClass('col-xs-8 col-xs-offset-2').addClass('col-xs-6 col-xs-offset-3');
            $('#admin > div:first-child').css({borderRight: 'none', borderBottom:'1px solid rgba(25, 107, 105, 1)'});
        }
        $('#my-observations').height($('#show').height()).css({overflow: 'auto'});
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

    function montrerDiv(elmt){
        deselectionnerTabs();
        selectionnerTab(elmt);
        divTabActive.hide('slide', {direction: 'left'}, function(){
            elmt.show('slide', {direction: 'left'});
        });
        divTabActive = elmt;
    }

});