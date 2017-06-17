/**
 * web/js/.js
 * Créé par firekey le 16/06/2017.
 */

$(function () {

    /* ========================= VARIABLES ========================= */

    var iconProtegee = L.icon({
        iconUrl: '../../web/imgs/icon-espece-protegee.png',
        iconSize: [45, 64],
        iconAnchor: [22.5, 32]
    });
    var iconNonProtegee = L.icon({
        iconUrl: '../../web/imgs/icon-espece-non-protegee.png',
        iconSize: [45, 64],
        iconAnchor: [22.5, 32]
    });


    /* ========================= ACTIONS POST-LOAD ========================= */


    var marker=L.marker(['.$data2['Latitude'].','.$data2['Longitude'].'],{icon:customIcon}).addTo(mymap);
    marker.bindPopup("<u>Identifiant :</u><br>'.$data2['Identifiant'].'<br><br><u>Position :</u><br>'.$data2['Position'].'<br><br><u>Poste :</u><br>'.$data2['Nom'].'<br><br><u>Commune :</u><br>'.$data2['Commune'].'<br><br>Latitude : '.$data2['Latitude'].'<br>Longitude : '.$data2['Longitude'].'");


    /* ========================= GESTION EVENEMENTIELLE ========================= */


    /* ========================= FONCTIONS ========================= */


});