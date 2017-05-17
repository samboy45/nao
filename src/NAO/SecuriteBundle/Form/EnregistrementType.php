<?php

namespace NAO\SecuriteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class EnregistrementType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomUtilisateur')
            ->add('prenomUtilisateur');
    }

    public function getParent()
    {
        return 'fos_user_registration';

    }

    public function getName()
    {
        return 'nao_securite_enregistrement';
    }





}
