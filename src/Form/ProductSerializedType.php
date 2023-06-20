<?php

namespace App\Form;

use App\Entity\ProductSerialized;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSerializedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Marque',
                ],
                'required' => false
            ])
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Désignation',
                ],
                'required' => false
            ])
            ->add('reference', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Référence',
                ],
                'required' => false
            ])
            ->add('serial_number', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Numéro de série',
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductSerialized::class,
        ]);
    }
}
