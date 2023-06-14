<?php

namespace App\DataFixtures;

use App\Entity\ProductSerialized;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductsSerializedFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; ++$i) {
            $productSerialized = new ProductSerialized();
            $productSerialized->setName($faker->words(4, true))
                ->setBrand($faker->words(1, true))
                ->setReference($faker->bothify('???-###').'-'.$faker->bothify('???'))
                ->setSerialNumber(mt_rand(100000000000, 999999999999))
            ;

            $manager->persist($productSerialized);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProductSerialized::class];
    }
}
