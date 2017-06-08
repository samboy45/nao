/**
 * web/js/map-recherche-1.js
 * Created by firekey on 02/06/2017.
 */

$(function(){
    var carte = L.map('carte-rechercher').setView([46.785575, 2.355276], 6);
    L.tileLayer('https://api.mapbox.com/styles/v1/firekey-829/cj2vyzk0q004r2sob9ac581b2/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmlyZWtleS04MjkiLCJhIjoiY2oydnk1cGxqMDA2eTJ3bXVuZzFjYzg0biJ9.fkx1oR2TTVyqU2EMc6XDgg',
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