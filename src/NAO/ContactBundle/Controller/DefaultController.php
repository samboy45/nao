<?php

namespace NAO\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
                // Send mail
                if($this->envoiEmail($form->getData())){

                    return $this->redirectToRoute('nao_contact_homepage');
                }else{
                    var_dump("oupsss :(");
                }
            }
        }

        return $this->render('NAOContactBundle::contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function envoiEmail($data){
        $ContactEmail = 'monMailDeContact@mail.com';
        $ContactMotDePasse = 'votreMotDePasseMail';


        $transport = \Swift_SmtpTransport::newInstance('', '','')
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