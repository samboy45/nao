<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 14/06/2017
 * Time: 16:33
 */

namespace AppBundle\Service;


class MailerService
{
    private $mailer;
    private $templating;
    public function __construct(\Swift_Mailer $mailer, \Symfony\Bundle\TwigBundle\TwigEngine $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }


    public function sendMail($observation)
    {
        $message = new \Swift_Message();
        $message
            ->setSubject('Refus observation')
            ->setFrom(array('samboydu@gmail.com' => 'Nos Amis les Oiseaux'))
            ->setTo($observation->getUser()->getEmail())
            ->setContentType('text/html')
            ->setBody($this->templating->render('mail.html.twig', array(
                'observation' => $observation
            )));
        $this->mailer->send($message);
    }
}