<?php

namespace App\Form;

use App\Entity\Voyage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('horaire_at', DateTimeType::class,[
                'label' => 'Horaire'
            ])
            ->add('nbPlaces', IntegerType::class, [
                'label' => 'Nombre de places'
            ])
            ->add('ville_depart', TextType::class, [
                'label' => 'Ville de départ'
            ])
            ->add('ville_arrive', TextType::class, [
                'label' => 'Ville d\'arrivée'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
