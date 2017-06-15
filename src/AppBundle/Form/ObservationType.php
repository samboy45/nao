<?php

namespace AppBundle\Form;

use AppBundle\Entity\Espece;
use AppBundle\Entity\Famille;
use AppBundle\Entity\Ordre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', FileType::class, array(
                'required' => false
            ))
            ->add('date', DateType::class)
            ->add('ordre', EntityType::class, array(
                'class' => 'AppBundle\Entity\Ordre',
                'placeholder' => 'Selectionnez l\'ordre',
                'mapped' => false,
                'required' => false
            ))
            ->add('latitude',TextType::class,array(
                'attr' =>['class' => 'hidden']
            ))
            ->add('longitude',TextType::class,array(
                'attr' => ['class' => 'hidden']
            ));
        $builder->get('ordre')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addFamilleField($form->getParent(), $form->getData());
            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                /* @var $espece Espece */
                $espece = $data->getEspece();
                $form = $event->getForm();
                if ($espece) {
                    $famille = $espece->getFamille();
                    $ordre = $famille->getOrdre();
                    $this->addFamilleField($form, $ordre);
                    $this->addEspeceField($form, $famille);
                    $form->get('ordre')->setData($ordre);
                    $form->get('famille')->setData($famille);
                } else {
                    $this->addFamilleField($form, null);
                    $this->addEspeceField($form, null);
                }
            }
        );
    }



    private function  addFamilleField(FormInterface $form, Ordre $ordre =null){
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'famille',
            EntityType::class,
            null,
            [
                'class' => 'AppBundle\Entity\Famille',
                'placeholder'     => $ordre ? 'Sélectionnez la famille' : 'Sélectionnez l\'ordre',
                'mapped'          => false,
                'required'        => false,
                'auto_initialize' => false,
                'choices'         => $ordre ? $ordre->getFamilles() : []
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addEspeceField($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }


    private function addEspeceField(FormInterface $form, Famille $famille = null)
    {
        $form->add('espece', EntityType::class, [
            'class'       => 'AppBundle\Entity\Espece',
            'placeholder' => $famille ? 'Sélectionnez l\'oiseau' : 'Sélectionnez la famille',
            'choices'     => $famille ? $famille->getEspeces() : []
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Observation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_observation';
    }


}
