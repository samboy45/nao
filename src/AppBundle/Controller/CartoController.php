<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartoController extends Controller
{
    public function afficherOiseauxAction(Request $requete)
    {
        if ($requete->isXmlHttpRequest()){
            $oiseaux = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Observation')
                ->trouverOiseauxRecherches($requete->request->get('espece'));
            ;
            return new JsonResponse(array('oiseaux' => $oiseaux));
        } else {
            return new Response('Ce type de requête est inapproprié', 400);
        }
    }
}
