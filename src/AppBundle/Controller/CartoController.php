<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartoController extends Controller
{
    public function afficherOiseauxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()){
            $espece = $request->request->get('espece');
            $em = $this
                ->getDoctrine()
                ->getManager();
            $observationsValidees = $em
                ->getRepository('AppBundle:Observation')
                ->findBy(
                    array(
                        'active' => true
                    )
                );
            $famille = $em
                ->getRepository('AppBundle:Famille')
                ->findBy(
                    array(
                        'nomFamille' => $espece
                    )
                );
            $reponse = new JsonResponse(
                array(
                    'tableau' => array(
                        'observations' => $observationsValidees,
                        'oiseaux' => $famille->getEspeces()
                    )
                )
            );
            return $reponse;
        } else {
            return new Response('Ce type de requête est inapproprié', 400);
        }
    }
}
