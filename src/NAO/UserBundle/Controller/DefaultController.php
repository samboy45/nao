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


    public function listeDesUtilisateursAction() {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render("Utilisateur/liste_utilisateurs.html.twig", array('users' =>   $users));

    }

    public function listeDesUtilisateurParRoleAction($role)
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT u FROM UserBundle:User u WHERE u.roles LIKE :role'
            )->setParameter('role', '%"' . $role . '"%');

        $users = $query->getResult();
        return $this->render("Utilisateur/liste_utilisateurs.html.twig", array('users' =>   $users));
    }

    public function trouverUnUtilisateursAction($id) {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('username' => $id));
        return $user;

    }

    public function modifierUnUtilisateursAction($id) {
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->trouverUnUtilisateursAction($id);
        //$user->setEmail('cetemail@nexiste.pas');
        $userManager->updateUser($user);

    }

    public function supprimerUnUtilisateur($id){
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->trouverUnUtilisateursAction($id);
        $userManager->deleteUser($user);
    }




}
