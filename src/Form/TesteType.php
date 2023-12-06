<?php

namespace App\Form;

use App\Entity\Teste;
use App\Entity\TypeTeste;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TesteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('description')
            ->add('imageTeste', FileType::class, [
                'required' => False,
                'data_class' => null,
                'mapped' => false
            ])
            ->add('typeTeste', EntityType::class, [
                'class' => TypeTeste::class
            ])
            ->add('criteres', CollectionType::class, [
                'label' => false,
                'entry_type' => CritereType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('questions', CollectionType::class, [
                'label' => false,
                'entry_type' => QuestionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_options' => [
                    'teste' => $options['data'],
                ]
            ])
            // Permet de mettre le button à la fin
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teste::class
        ]);
    }
}
