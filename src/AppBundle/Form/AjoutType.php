<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 01/06/2017
 * Time: 12:51
 */

namespace AppBundle\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AjoutType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('EspeceProtegee');
        $builder->remove('especeNonProtegeer');

    }

    public function getParent()
    {
        return ObservationType::class;
    }



}