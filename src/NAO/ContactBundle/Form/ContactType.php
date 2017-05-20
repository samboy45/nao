<?php
/**
 * Created by PhpStorm.
 * User: yclem001
 * Date: 20/05/2017
 * Time: 10:38
 */

namespace NAO\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('attr' => array('placeholder' => 'Votre nom'),
                'constraints' => array(
                    new NotBlank(array("message" => "Merci de renseigner votre Nom")),
                )
            ))
            ->add('prenom', TextType::class, array('attr' => array('placeholder' => 'Votre prénom'),
                'constraints' => array(
                    new NotBlank(array("message" => "Merci de renseigner votre Prénom")),
                )
            ))
            ->add('sujet', TextType::class, array('attr' => array('placeholder' => 'Votre demande'),
                'constraints' => array(
                    new NotBlank(array("message" => "Merci d'indiquer la nature de votre demande")),
                )
            ))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'Votre adresse e-mail'),
                'constraints' => array(
                    new NotBlank(array("message" => "Merci de renseigner un email valide")),
                    new Email(array("message" => "Votre email ne semble pas valide")),
                )
            ))
            ->add('message', TextareaType::class, array('attr' => array('placeholder' => 'Qu\'elle est votre demande'),
                'constraints' => array(
                    new NotBlank(array("message" => "Merci de renseigner votre demande")),
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    public function getName()
    {
        return 'contact_form';
    }

}