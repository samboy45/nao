/**
 * web/js/map-recherche-1.js
 * Créé par firekey le 02/06/2017.
 */

$(function(){

    /* ========================= VARIABLES ========================= */

    var carte;

    var iconPosition = L.icon({
        iconUrl: '../../web/imgs/icon-position@4x.png',
        iconSize: [64, 64],
        iconAnchor: [32, 32]
    });


    /* ========================= ACTIONS ========================= */

    carte = L.map('carte-rechercher').setView([46.785575, 2.355276], 6);

    L.tileLayer('https://api.mapbox.com/styles/v1/julobrsd/cj2x40f2z001p2rod8xkal2c9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoianVsb2Jyc2QiLCJhIjoiY2oyeDNwMW5nMDB4ODM4cHV4ZWkwMjk0YSJ9.TworUnb_y8Jf5blBUVuRxQ',
        {
            attribution: '<a href="#">Nos Amis les Oiseaux</a> | <a href="#">Ex-Nihilo.com</a>',
            maxZoom: 18
        }
    ).addTo(carte);

    if (navigator.geolocation){
        navigator.geolocation.watchPosition(
            function(position){
                var marqueur = L.marker([position.coords.latitude, position.coords.longitude], {icon: iconPosition});
                marqueur.addTo(carte);
            },
            function(erreur){
                switch(erreur.code){
                    case erreur.PERMISSION_DENIED: alert('Suite à votre refus la géolocalisation n\'a pas été effectuée'); break;
                    case erreur.POSITION_UNAVAILABLE: alert('Une erreur est survenue durant la géolocalisation. Votre position reste indéterminée'); break;
                    case erreur.TIMEOUT: alert('Le délai de réponse de la géolocalisation est dépassé, réitérez l\'opération'); break;
                }
            }
        ), {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 60000
        };
    } else {
        alert('Votre navigateur ne prends pas en charge la géolocalisation.');
    }

});