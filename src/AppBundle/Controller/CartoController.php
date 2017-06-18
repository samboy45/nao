<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartoController extends Controller
{
    public function importerOiseauxAction(Request $requete)
    {
        if ($requete->isXmlHttpRequest()){
            return new JsonResponse(
                json_encode($this
                    ->getDoctrine()
                    ->getRepository('AppBundle:Observation')
                    ->importerOiseaux($requete
                        ->request
                        ->get('espece')
                    )
                ),
                200
            );
        } else {
            return new Response('Requête invalide', 400);
        }
    }
}
