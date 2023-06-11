<?php

namespace App\Form;

use App\Entity\ProductSerialized;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSerialized1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('reference')
            ->add('serial_number')
            ->add('quantity')
            ->add('brand')
            ->add('addedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductSerialized::class,
        ]);
    }
}
