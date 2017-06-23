<?php

namespace NAO\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{


    public function indexAction()
    {
        $users = $this->get('fos_user.user_manager')->findUsers();

        return $this->render(':admin/utilisateurs:index.html.twig', array('users' => $users));
    }


    public function utilisateurAction() {
        $user= $this->getUser();
        $userObservations = $this->getDoctrine()->getManager()->getRepository('AppBundle:Observation')->findBy(array('user' => $user), array('id' => 'desc'));
        $userObservationsValidate = [];
        $userObservationsWaiting = [];
        foreach ($userObservations as $userObservation){
            if ($userObservation->getActive()){
                $userObservationsValidate[] = $userObservation;
            }
            if (!$userObservation->getActive()){
                $userObservationsWaiting[] = $userObservation;
            }
        }
        $countUserObservations = count($userObservations);
        $countUserObservationsValidate = count($userObservationsValidate);
        $countUserObservationsWaiting = count($userObservationsWaiting);

        return $this->render("utilisateur/moncompte.html.twig", array(
            'userObservations' => $userObservations,
            'userObservationsValidate' => $userObservationsValidate,
            'userObservationsWaiting' => $userObservationsWaiting,
            'countUserObservations' => $countUserObservations,
            'countUserObservationsValidate' => $countUserObservationsValidate,
            'countUserObservationsWaiting' => $countUserObservationsWaiting
        ));
    }


    public function rechercheAction(Request $request)
    {
        $form = $this->createFormBuilder(null)->add('recherche', TextType::class, array('attr' => array('placeholder' => 'Recherche')))->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $recherche = $form->getData() ;
            $users = $this->getDoctrine()->getRepository('UserBundle:User')->filtrerUtilisateurs($recherche['recherche']);

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
            ))->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()){
            $role = $form->getData();
            $users = $this->getDoctrine()->getRepository('UserBundle:User')->filtrerParRole($role['roles']);

            return $this->render('admin/utilisateurs/index.html.twig', array('users' => $users));
        }

        return $this->render(':admin/utilisateurs:role.html.twig', array('form' => $form->createView()));
    }

}
