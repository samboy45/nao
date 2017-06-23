<?php

namespace NAO\UserBundle\Controller;

use NAO\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class UserController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserBundle:User')->findAll();

        return $this->render('admin/utilisateurs/index.html.twig', array(
            'users' => $users,
        ));
    }


    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('NAO\UserBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_mon_compte_show');
            //return $this->redirectToRoute('admin_utilisateurs_show', array('id' => $user->getId()));
        }

        return $this->render('admin/utilisateurs/ajouter.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('admin/utilisateurs/afficher.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('NAO\UserBundle\Form\UserEditType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() AND $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_utilisateurs_edit', array('id' => $user->getId()));
        }

        return $this->render('admin/utilisateurs/editer.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('admin_utilisateurs_index');
    }

    /**
     *
     * @param User $user
     *
     * @return \Symfony\Component\Form\Form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_utilisateurs_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
