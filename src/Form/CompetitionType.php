<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Discipline;
use App\Entity\Entraineur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('discipline',EntityType::class,[
                'class' => Discipline::class,
                'choice_label' => 'sport'
            ])
            ->add('titre')
            ->add('date_debut')
            ->add('date_fin')
            ->add('lieu')
            ->add('description')
            ->add('entraineur',EntityType::class,[
                'class' => Entraineur::class,
                'choice_label' => function(Entraineur $entraineur){
                    return $entraineur->getNom().' '.$entraineur->getPrenom();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
