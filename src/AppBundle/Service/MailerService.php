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
    private $twig;
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }


    public function sendMail($user)
    {
        $message = new \Swift_Message();

        $message
            ->setSubject('Refus observation')
            ->setFrom(array('' => 'Nos Amis les Oiseaux'))
            ->setTo($user->getEmail())
            ->setContentType('text/html')
            ->setBody($this->twig->render('', array()));
    }
}