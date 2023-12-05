<?php

namespace App\Form;

use App\Entity\Teste;
use App\Entity\Critere;
use App\Entity\Solution;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolutionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomSolution')
            ->add('point')
            ->add('critere', EntityType::class, [
                'class' => Critere::class,
                // 'choices' => $options['teste']->getCriteres() Marche pas
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Solution::class,
            'teste' => null
        ]);

        $resolver->setRequired('teste');
    }
}
