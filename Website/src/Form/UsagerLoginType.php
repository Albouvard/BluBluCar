<?php

namespace App\Form;

use App\Entity\Usager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsagerLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('ddn_at', BirthdayType::class,[
                'label' => 'Date de naissance'
            ])
            ->add('pseudo')
            ->add('mail', EmailType::class)
            ->add('telephone',NumberType::class)
            ->add('motdepasse',PasswordType::class, [
                'label'=> 'Mot de passe',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usager::class,
            'translation_domain' => 'forms'
        ]);
    }
}
