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
                    // Send mail
                    if($this->envoiEmail($form->getData())){

                        return $this->redirectToRoute('nao_contact_homepage');
                    }else{
                        var_dump("oupsss :(");
                    }
                }


            }
        }



        return $this->render('NAOContactBundle::contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function envoiEmail($data){
        $ContactEmail = ''; //mettre email de contact
        $ContactMotDePasse = ''; // mettre mot de passe de l'adresse mail de contact


        $transport = \Swift_SmtpTransport::newInstance('ssl0.ovh.net', '587','tls' )
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