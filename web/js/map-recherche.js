/**
 * web/js/map-recherche-1.js
 * Created by firekey on 02/06/2017.
 */

$(function(){
    var carte = L.map('carte-rechercher').setView([46.785575, 2.355276], 6);
    L.tileLayer('https://api.mapbox.com/styles/v1/julobrsd/cj2x40f2z001p2rod8xkal2c9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoianVsb2Jyc2QiLCJhIjoiY2oyeDNwMW5nMDB4ODM4cHV4ZWkwMjk0YSJ9.TworUnb_y8Jf5blBUVuRxQ',
        {
            attribution: '<a href="#">Nos Amis les Oiseaux</a> | <a href="#">Ex-Nihilo.com</a>',
            maxZoom: 10
        }
    ).addTo(carte);


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    window.addEventListener(
        'resize',
        function()
        {

        }
    );


    /* ========================= FONCTIONS ========================= */


});
