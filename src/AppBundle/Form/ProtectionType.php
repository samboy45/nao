<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProtectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('EspeceProtegee', CheckboxType::class, array(
                'required' => false,
                'label' => 'Espèce protegée'
            ))
            ->add('especeNonProtegeer', CheckboxType::class,array(
                'required' => false,
                'label' => 'Espèce non protégée'
            ))

            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Observation'
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_protection_type';
    }
}
