<?php

namespace App\Form;

use App\Entity\Critere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CritereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('scoreMax')
            ->add('scoreDefaut')
            ->add('interpretationMaxTexte')
            ->add('interpretationMinTexte')
            ->add('interpretationMaxCouleur')
            ->add('interpretationMinCouleur')
            ->add('interpretationMaxImage', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('interpretationMinImage', FileType::class, [
                'required' => false,
                'data_class' => null
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Critere::class,
        ]);
    }
}
