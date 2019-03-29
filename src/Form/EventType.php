<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EventType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => "Nom de l'événement"
                ),
            ))
            ->add('startAt', null, array(
                'date_widget' => 'single_text',
                'label' => 'Début'
            ))
            ->add('endAt', null, array(
                'date_widget' => 'single_text',
                'label' => 'Fin'
            ))
            ->add('description', null, array(
                'attr' => array(
                    'rows' => 4
                )
            ))
            ->add('capacity', null, array(
                'label' => 'Capacité',
            ))
            ->add('price', MoneyType::class, array(
                'label' => 'Prix'
            ))
            ->add('picture', UrlType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => "URL de l'image"
                ),
            ))
            ->add('place', EntityType::class, array(
                'class' => Place::class,
                'choice_label' => function( $place ){
                    return $place->getName() . ' - ' . $place->getCity();
                },
                'label' => 'Lieu',
            ))
            ->add('categories', null, array(
                'choice_label' => 'name',
                'expanded' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }

}
