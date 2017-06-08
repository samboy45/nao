<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Observation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ObservationController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $waitingObservations = $em->getRepository('AppBundle:Observation')->findByActive(0);

        return $this->render('observation/index.html.twig', array(
            'observations' => $waitingObservations,
        ));
    }


    public function newAction(Request $request)
    {
        $observation = new Observation();
        $form = $this->createForm('AppBundle\Form\ObservationType', $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if ($fichier = $observation->getImage() != null){
                $nomFichier = $this->get('nao_observations.fileUploader')->upload($observation->getImage());
                $observation->setImage($nomFichier);
            }
            $observation->setUser($user);
            if ($user->getRoles()== 'particulier'){
                $observation->setActive(false);
            }else{
                $observation->setActive(true);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($observation);
            $em->flush();

            return $this->redirectToRoute('observation_confirmation');
        }

        return $this->render('observation/new.html.twig', array(
            'observation' => $observation,
            'form' => $form->createView(),
        ));
    }

    public function confirmationAction()
    {
        return $this->render(':observation:confirmation.html.twig');

    }


    public function showAction(Observation $observation)
    {
        $deleteForm = $this->createDeleteForm($observation);

        return $this->render('observation/show.html.twig', array(
            'observation' => $observation,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function validateAction(Request $request, Observation $observation)
    {
        $deleteForm = $this->createDeleteForm($observation);
        $validateForm = $this->createForm('AppBundle\Form\ValidateType', $observation);
        $validateForm->handleRequest($request);

        if ($validateForm->isSubmitted() && $validateForm->isValid()){

            if ($fichier = $observation->getImage() != null) {
                $nomFichier = $this->get('nao_observations.fileUploader')->upload($observation->getImage());
                $observation->setImage($nomFichier);
            }
            $observation->setActive(true);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('observation_validate', array('id' => $observation->getId()));
        }

        return $this->render('observation/validate.html.twig', array(
            'observation' => $observation,
            'validate_form' => $validateForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Observation $observation)
    {
        $form = $this->createDeleteForm($observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($observation);
            $em->flush();
        }

        return $this->redirectToRoute('observation_index');
    }


    private function createDeleteForm(Observation $observation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('observation_delete', array('id' => $observation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function myObservationsAction(){
        $user= $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $userObservations = $em->getRepository('AppBundle:Observation')->findMyObservations($user);
        $userObservationsValidate = $em->getRepository('AppBundle:Observation')->findMyObservationsValidate($user);
        $userObservationsWaiting = $em->getRepository('AppBundle:Observation')->findMyObservationsWaiting($user);

        return $this->render('observation/mesObservations.html.twig', array(
            'userObservations' => $userObservations,
            'userObservationsValidate' => $userObservationsValidate,
            'userObservationsWaiting' => $userObservationsWaiting
        ));

    }

}
