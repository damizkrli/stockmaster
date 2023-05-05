<?php

namespace App\DataFixtures;

use App\Entity\Supply;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SuppliesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
            $product = new Supply();
            $product->setName($faker->words(2, true))
                ->setReference($faker->bothify('???-###') . '-' . $faker->bothify('???'))
                ->setQuantity($faker->randomDigit())
            ;

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SuppliesFixtures::class];
    }

}