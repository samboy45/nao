/**
 * web/js/map-recherche-1.js
 * Created by firekey on 02/06/2017.
 */

$(function(){
    var carte = $('#carte-recherche-1');
    redimensionnerCarte();
    initialiserCarte();


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    window.addEventListener(
        'resize',
        function()
        {
            redimensionnerCarte();
        }
    );


    /* ========================= FONCTIONS ========================= */

    function redimensionnerCarte()
    {
        var largeur = carte.width();
        if (largeur < 750){
            carte.height(largeur/0.5625)
        } else {
            carte.height(largeur*0.5625);
        }
    }

    function initialiserCarte()
    {
        var carteElmt = L.map(carte).setView([46.785575, 2.355276], 8);
        L.tileLayer('https://api.mapbox.com/styles/v1/julobrsd/cj2x40f2z001p2rod8xkal2c9/tiles/256/%7Bz%7D/%7Bx%7D/%7By%7D?access_token=pk.eyJ1IjoianVsb2Jyc2QiLCJhIjoiY2oyeDNwMW5nMDB4ODM4cHV4ZWkwMjk0YSJ9.TworUnb_y8Jf5blBUVuRxQ', {
            attribution: 'NAO | Ex-Nihilo',
            maxZoom: 8
        }).addTo(carteElmt);

    }

    function remplirListeEspeces()
    {
        var selectElmt = $('#select-recherche-home-2');

    }

    function placerMarqueurs()
    {

    }














});