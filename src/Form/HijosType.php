<?php

namespace App\Form;

use App\Entity\Grupos;
use App\Entity\Hijos;
use App\Entity\Notificacion;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HijosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('fechaNacimiento', DateType::class, [
                'years' => range(date('Y') - 3, date('Y')),
            ])
            // ->add('user', EntityType::class, [
            //     'label'=> "Padre/Madre/Tutor Legal: ",
            //     'class' => User::class,
            //     'choice_label' => 'Nombre' // o cualquier otro campo que desees mostrar en el formulario
            // ])
            ->add('grupos', EntityType::class, [
                'class'=> Grupos::class,
                'choice_label'=>"nombre"
            ])
            // ->add('notificacion', EntityType::class,[
            //     'class'=> Notificacion::class,
            //     'choice_label'=>"Asunto"
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hijos::class,
        ]);
    }
}
