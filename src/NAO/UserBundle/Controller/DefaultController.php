<?php

namespace NAO\UserBundle\Controller;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;



class DefaultController extends Controller
{


    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }


    public function utilisateurAction() {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render("utilisateur/moncompte.html.twig", array('users' =>   $users));

    }






}
