<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => false
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => false
                ]
            )
            ->add(
                'price',
                NumberType::class,
                [
                    'label' => false
                ]
            )
            ->add(
                'image',
                FileType::class,
                [
                    'label' => false,
                    'required' => false
                ]
            )
            ->add(
                'category',
                ChoiceType::class,
                [
                    'label' => false,
                    'choices' => array('Coffret série' => 'Coffret série', 'DVD & Blue-ray' => 'DVD & Blue-ray', 'Goodies' => 'Goodies'),
                    'placeholder' => 'Choisir une option'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
