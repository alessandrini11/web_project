<?php

namespace App\Form;

use App\Entity\Discipline;
use App\Entity\Entraineur;
use App\Entity\Poste;
use App\Entity\Sexe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntraineurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('lieu_naissance')
            ->add('taille')
            ->add('poids')
            ->add('sexe',EntityType::class,[
                'class' => Sexe::class,
                'choice_label' => 'nom'
            ])
            ->add('discipline',EntityType::class,[
                'class' => Discipline::class,
                'choice_label' => 'sport'
            ])
            ->add('poste',EntityType::class,[
                'class' => Poste::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entraineur::class,
        ]);
    }
}
