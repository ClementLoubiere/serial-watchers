<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, ['label' => 'Pseudo'])
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('plainPassword',
                RepeatedType::class,
                ['type' => PasswordType::class,
                    'first_options' => [
                        'label' => 'Mot de passe'],
                    'second_options' => [
                        'label' => 'Confirmation du mot de passe'
                    ],
                    'invalid_message' => 'La confirmation du mot de passe ne correspond pas au mot de passe saisi']
                )
            ->add('gender',
                ChoiceType::class,
                [
                    'label' => 'Sexe',
                    'choices' => ['Homme' => 'H', 'Femme' => 'F'],
                    'expanded' => true,
                    'multiple' => false]
            )
            ->add('birthdate',
                DateType::class,
                    ['widget' => 'single_text',
                    'format' => 'yyyy-mm-dd',
                        'invalid_message' => 'La date doit être inscrite en yyyy-mm-dd']
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
