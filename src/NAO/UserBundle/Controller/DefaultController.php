<?php

namespace NAO\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;




class DefaultController extends Controller
{


    public function indexAction()
    {
        return $this->render(':admin/utilisateurs:index.html.twig');
    }


    public function utilisateurAction() {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        $user= $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $userObservations = $em->getRepository('AppBundle:Observation')->findMyObservations($user);
        $userObservationsValidate = $em->getRepository('AppBundle:Observation')->findMyObservationsValidate($user);
        $userObservationsWaiting = $em->getRepository('AppBundle:Observation')->findMyObservationsWaiting($user);
        $countUserObservations = $em->getRepository('AppBundle:Observation')->countMyObservations($user);
        $countUserObservationsValidate = $em->getRepository('AppBundle:Observation')->countMyObservationsValidate($user);
        $countUserObservationsWaiting = $em->getRepository('AppBundle:Observation')->countMyObservationsWaiting($user);

        return $this->render("utilisateur/moncompte.html.twig", array(
            'users' => $users,
            'userObservations' => $userObservations,
            'userObservationsValidate' => $userObservationsValidate,
            'userObservationsWaiting' => $userObservationsWaiting,
            'countUserObservations' => $countUserObservations,
            'countUserObservationsValidate' => $countUserObservationsValidate,
            'countUserObservationsWaiting' => $countUserObservationsWaiting));
    }


    public function rechercheAction(Request $request)
    {
        $form = $this
            ->createFormBuilder(null)
            ->add('recherche', TextType::class, array('attr' => array('placeholder' => 'Recherche')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $recherche = $form->getData() ;
            $users = $this
                ->getDoctrine()
                ->getRepository('UserBundle:User')
                ->filtrerUtilisateurs($recherche['recherche']);

            return $this->render('admin/utilisateurs/index.html.twig', array('users' => $users));
        }

        return $this->render(':admin/utilisateurs:filtrer.html.twig', array('form' => $form->createView()));
    }

    public function rechercheRoleAction(Request $request)
    {
        $form = $this->createFormBuilder(null)
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Tous' => null,
                    'Particulier' => 'i:0',
                    'Naturaliste' => 'ROLE_NATURALISTE',
                    'Administrateur' => 'ROLE_ADMIN'
                )
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()){
            $role = $form->getData();
            $users = $this
                ->getDoctrine()
                ->getRepository('UserBundle:User')
                ->filtrerParRole($role['roles']);

            return $this->render('admin/utilisateurs/index.html.twig', array('users' => $users));
        }

        return $this->render(':admin/utilisateurs:role.html.twig', array('form' => $form->createView()));
    }

}
