<?php

namespace App\Form;

use App\Entity\Hijos;
use App\Entity\Tasas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TasasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FechaPago', DateType::class, [
                'years' => range(date('Y') - 3, date('Y')),
            ])
            ->add('cantidad')
            ->add('pagado')
            ->add('nombre')
            ->add('alumno',EntityType::class, [
                'class' => Hijos::class,
                'choice_label' => 'Nombre' //
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tasas::class,
        ]);
    }
}
