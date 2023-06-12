<?php

namespace App\Form;

use App\Entity\User;
use PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles', ChoiceType::class, [
            //     'multiple' => true,
            //     'choices' => [
            //         'ROLE_ADMIN' => 'ROLE_ADMIN',
            //         'ROLE_USER' => 'ROLE_USER',
            //     ],
            // ])
            // ->add('password') No vamos a cambiar la contraseña. Si la cambias la lias.
            ->add('Nombre')
            ->add('telefono')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
