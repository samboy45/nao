<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

    public function dashboardAction(Request $request)
    {
        $users = $this->get('fos_user.user_manager')->findUsers();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $form = $this->createFormBuilder(null)->add('recherche', TextType::class, array('attr' => array('placeholder' => 'Recherche')))->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $recherche = $form->getData() ;
            $users = $this->getDoctrine()->getRepository('UserBundle:User')->filtrerUtilisateurs($recherche['recherche']);

            return $this->render("admin/utilisateurs/dashboard.html.twig", array('users' => $users));

        }

        $form2 = $this->createFormBuilder(null)
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Filtrer par rôles' => null,
                    'Tous' => null,
                    'Particulier' => 'i:0',
                    'Naturaliste' => 'ROLE_NATURALISTE',
                    'Administrateur' => 'ROLE_ADMIN'
                )
            ))->getForm();
        $form2->handleRequest($request);

        if ($form2->isSubmitted() AND $form2->isValid()){
            $role = $form2->getData();
            $users = $this->getDoctrine()->getRepository('UserBundle:User')->filtrerParRole($role['roles']);

            return $this->render("admin/utilisateurs/dashboard.html.twig", array('users' => $users));

        }

        return $this->render("admin/utilisateurs/dashboard.html.twig", array('users' => $users, 'user' => $user, 'form' => $form->createView() , 'form2' => $form2->createView()));
    }

    public function qsnAction()
    {
        return $this->render(':qsn:qui_sommes_nous.html.twig');
    }
}
