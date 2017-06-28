/* assets/js/nao.js - 23/05/2017 */

$(function() {
    redimentionnerHeader();
    $('#switch-2, #flip-2, #flip-3, #flip-4').hide();
    fonduH1Header();


    /* ========================= FONCTIONS ========================= */

    function redimentionnerHeader() {
        var header = $('header');
        var largeur = header.width();
        var hauteur;
        if (largeur > 800) {
            hauteur = largeur * 2 / 3;
        } else {
            hauteur = 550;
        }
        header.height(hauteur);
        if (largeur < 350) {
            $('#accroche h1').each(function() {
                var elmt = $(this);
                elmt.replaceWith('<h2>' + elmt.text() + '</h2>');
            });
        } else {
            $('#accroche h2').each(function() {
                var elmt = $(this);
                elmt.replaceWith('<h1>' + elmt.text() + '</h1>');
            });
        }
    }

    function fonduH1Header() {
        $('#flip-1').delay(1900).fadeOut(500, function() {
            $('#flip-2').fadeIn(500).delay(2000).fadeOut(500, function() {
                $('#flip-3').fadeIn(500).delay(2000).fadeOut(500, function() {
                    $('#flip-4').fadeIn(500).delay(2000).fadeOut(500, function() {
                        $('#flip-1').fadeIn(500).delay(100, fonduH1Header());
                    });
                });
            });
        });
    }


    /* ========================= GESTION EVENEMENTIELLE ========================= */

    window.addEventListener('resize', function(event) {
        redimentionnerHeader();
    });

    $('#droite').click(function() {
        $('#switch-1').fadeOut(500);
        setTimeout(function() {
            $('#switch-2').fadeIn(500)
        }, 495);
    });

    $('#gauche').click(function() {
        $('#switch-2').fadeOut(500);
        setTimeout(function() {
            $('#switch-1').fadeIn(500)
        }, 495);
    });

    $('nav a').on('click', function(e) {
        e.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
                scrollTop: $(this.hash).offset().top
            },
            1000,
            function() {
                window.location.hash = hash;
            }
        );
    });
});
