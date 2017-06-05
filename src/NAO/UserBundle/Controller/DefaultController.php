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



        return $this->render("utilisateur/moncompte.html.twig", array('users' =>   $users));
    }


    public function rechercheAction(Request $request)
    {
        $form = $this->createFormBuilder(null)
            ->add('recherche', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recherche = $form->getData() ;
            $query = $this->getDoctrine()->getManager()
                ->createQuery('SELECT u FROM UserBundle:User u 
                                  WHERE u.firstname LIKE :recherche
                                    OR u.lastname LIKE :recherche
                                    OR u.username LIKE :recherche
                                    OR u.email LIKE :recherche'
                )->setParameter('recherche', '%' . $recherche['recherche'] . '%' );

            $users = $query->getResult();
            return $this->render('admin/utilisateurs/index.html.twig', array(
                'users' => $users,
            ));
        }

        return $this->render(':admin/utilisateurs:filtrer.html.twig', array('form' => $form->createView() ));
    }

    public function rechercheRoleAction(Request $request)
    {
        $form = $this->createFormBuilder(null)
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Tous' => null,
                    'utilisateur' => 'i:0',
                    'Naturaliste' => 'ROLE_NATURALISTE',
                    'Administrateur' => 'ROLE_ADMIN'
                )
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $form->getData() ;
            $query = $this->getDoctrine()->getManager()
                ->createQuery('SELECT u FROM UserBundle:User u WHERE u.roles LIKE :role'
                )->setParameter('role', '%' . $role['roles'] . '%' );

            $users = $query->getResult();

            return $this->render('admin/utilisateurs/index.html.twig', array(
                'users' => $users,
            ));
        }

        return $this->render(':admin/utilisateurs:role.html.twig', array('form' => $form->createView() ));
    }







}
