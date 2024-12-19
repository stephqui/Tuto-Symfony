<?php
//Pour remplir de la donnée en DB en utilisant Faker + librairie tiers "restaurant"
//'composer require --dev fakerphp/fake'r
//'composer require --dev jzonta/faker-restaurant'

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use FakerRestaurant\Provider\fr_FR\Restaurant;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new Restaurant($faker));

        for ($i = 1; $i <= 10; $i++) {
            $recipes = (new Recipe())
                ->setTitle($faker->foodName())
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setContent($faker->paragraphs(10, true))
                ->setDuration($faker->numberBetween(10, 60));
                $manager->persist($recipes);
        }

        $manager->flush();
    }
}
