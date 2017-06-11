<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    public function rechercheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AppBundle:Famille')->findAll();
        return $this->render('default/recherche.html.twig', array('especes' => $liste));
    }

    public function mentionsLegalesAction()
    {
        return $this->render("mentions/mentions_legales.html.twig");
    }

    public function conditionsGeneralesUtlisationAction()
    {
        return $this->render("mentions/cgu.html.twig");
    }

    public function dashboardAction()
    {
        return $this->render("admin/utilisateurs/dashboard.html.twig");
    }

    public function qsnAction()
    {
        return $this->render(':qsn:qui_sommes_nous.html.twig');
    }
}
