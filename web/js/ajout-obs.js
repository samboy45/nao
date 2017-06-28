/**
 * web/js/ajout-obs.js
 * Créé par firekey le 23/06/2017.
 */

$(function(){

    /* ========================= ACTIONS POST-LOAD ========================= */

    $('.btn-nav').removeClass('active');
    $('#btn-nav-obs').addClass('active');

    if ($('#badge-obs').text() == '0'){
        $('#badge-obs').removeClass('bg-rouge').addClass('bg-herbe-tropicale');
    }

});