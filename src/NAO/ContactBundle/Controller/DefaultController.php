<?php

namespace NAO\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ReCaptcha\ReCaptcha;

class DefaultController extends Controller
{

    public function contactAction(Request $request)
    {
        $form = $this->createForm('NAO\ContactBundle\Form\ContactType',null,array(
            'action' => $this->generateUrl('nao_contact_homepage'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if($form->isValid()){

                $recaptcha = new ReCaptcha($this->getParameter('recaptcha_key'));
                $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

                if (!$resp->isSuccess()) {

                    $message = "Le reCAPTCHA n'a pas été entré correctement. Merci de réessayez.";

                    $this->get('session')->getFlashBag()->add('danger', $message);
                    return $this->redirectToRoute('nao_contact_homepage');
                } else {
                    // envoi mail
                    if($this->envoiEmail($form->getData())){

                        return $this->redirectToRoute('nao_contact_homepage');
                    }
                }


            }
        }



        return $this->render('NAOContactBundle::contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function envoiEmail($data){
        $ContactEmail = $this->getParameter('mailer_user'); //mettre email de contact
        $ContactMotDePasse = $this->getParameter('mailer_password'); // mettre mot de passe de l'adresse mail de contact


        $transport = \Swift_SmtpTransport::newInstance( $this->getParameter('mailer_host'),$this->getParameter('mailer_port'),$this->getParameter('mailer_security'))
            ->setUsername($ContactEmail)
            ->setPassword($ContactMotDePasse);

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance("Nouveau contact depuis notre formulaire: ". $data["sujet"])
            ->setFrom(array($ContactEmail => "Message de ".$data["nom"]))
            ->setTo(array(
                $ContactEmail => $ContactEmail
            ))
            ->setBody($data["message"]."<br>Email du contact :".$data["email"]);

        return $mailer->send($message);
    }

}