<?php

namespace App\Form;

use App\Entity\OutOfStock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OutOfStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Quantité'
                ]
            ])
            ->add('brand', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Marque'
                ]
            ])
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Désignation'
                ]
            ])
            ->add('reference', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Référence'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OutOfStock::class,
        ]);
    }
}
