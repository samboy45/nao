<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/06/17
 * Time: 13:57
 */

namespace NAO\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->remove('current_password')
            ->add('lastname', TextType::class, array(
                'label' => 'Nom'
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom'
            ))
            ->add('email', TextType::class, array(
                'label' => 'email'
            ));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()

    {
        return 'fos_user_profile_edit';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

}