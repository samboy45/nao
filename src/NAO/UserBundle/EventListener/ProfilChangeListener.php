<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 27/06/17
 * Time: 22:39
 */

namespace NAO\UserBundle\EventListener;


use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ProfilChangeListener implements EventSubscriberInterface {
    private $router;

    public function __construct(UrlGeneratorInterface $router) {
        $this->router = $router;
    }

    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::PROFILE_EDIT_SUCCESS => 'onProfilChangeSuccess',
        ];
    }

    public function onProfilChangeSuccess(FormEvent $event) {
        $url = $this->router->generate('user_mon_compte_show');
        $event->setResponse(new RedirectResponse($url));
    }
}