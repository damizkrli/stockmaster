<?php

namespace App\DataFixtures;

use App\Entity\ProdutSerialized;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductSerializedFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 500; ++$i) {
            $product_serialized = new ProdutSerialized();
            $product_serialized->setName($faker->words(4, true))
                ->setBrand($faker->words(1, true))
                ->setReference($faker->bothify('???-###').'-'.$faker->bothify('???'))
                ->setSerialNumber(mt_rand(100000000000, 999999999999))
                ->setQuantity($faker->randomDigit())
            ;

            $manager->persist($product_serialized);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProdutSerialized::class];
    }
}
