<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 01/06/2017
 * Time: 11:23
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;



class ValidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('date');
        $builder->remove('image');

    }

    public function getParent()
    {
        return ObservationType::class;
    }



}