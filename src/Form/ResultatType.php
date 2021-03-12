<?php

namespace App\Form;

use App\Entity\Athlete;
use App\Entity\Classement;
use App\Entity\Resultat;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('athlete',EntityType::class,[
                'class' => Athlete::class,
                'choice_label' => function(Athlete $athlete){
                    return $athlete->getNom().' '. $athlete->getPrenom();
                }
            ])
            ->add('description')
            ->add('classement',EntityType::class,[
                'class' => Classement::class,
                'choice_label' =>  'nom'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resultat::class,
        ]);
    }
}
