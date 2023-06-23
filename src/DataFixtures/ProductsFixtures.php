<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 150; ++$i) {
            $product = new Product();
            $product->setName($faker->words(4, true))
                ->setBrand($faker->words(1, true))
                ->setReference($faker->bothify('???-###').'-'.$faker->bothify('???'))
                ->setQuantity($faker->randomDigitNotZero())
                ->setDescription($faker->paragraph);

            if (1 === $product->getQuantity()) {
                $product->setSerialNumber(mt_rand(100000000000, 999999999999));
            }

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProductsFixtures::class];
    }
}
