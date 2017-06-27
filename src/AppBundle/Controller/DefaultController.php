<?php

namespace AppBundle\Controller;

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

    public function rechercheAction(Request $requete)
    {
        $donnees = [];
        $donnees['liste'] = $this->getDoctrine()->getManager()->getRepository('AppBundle:Famille')->findAll();
        if ($requete->isMethod('POST')){
            $donnees['especeSelectionnee'] = $requete->request->get('espece');
        }

        return $this->render('default/recherche.html.twig', array('donnees' => $donnees));
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
        $users = $this->get('fos_user.user_manager')->findUsers();

        return $this->render("admin/utilisateurs/dashboard.html.twig", array('users' => $users));
    }

    public function qsnAction()
    {
        return $this->render(':qsn:qui_sommes_nous.html.twig');
    }
}
