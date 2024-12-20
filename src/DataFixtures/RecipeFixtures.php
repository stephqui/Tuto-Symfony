<?php
//Pour remplir de la donnée en DB en utilisant Faker + librairie tiers "restaurant"
//'composer require --dev fakerphp/fake'r
//'composer require --dev jzonta/faker-restaurant'

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use FakerRestaurant\Provider\fr_FR\Restaurant;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly SluggerInterface $slugger){

    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new Restaurant($faker));

        $categories=['Plat chaud', 'Dessert', 'Entrrée', 'Gouter'];
        foreach ($categories as $c){
            $category=(new Category())
            ->setName($c)
            ->setSlug($this->slugger->slug($c))
            ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
            ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $manager->persist($category);
            $this->addReference($c,$category);
        }

        for ($i = 1; $i <= 10; $i++) {
            $title=$faker->foodName();
            $recipes = (new Recipe())
                ->setTitle($title)
                ->setSlug($this->slugger->slug($title))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setContent($faker->paragraphs(10, true))
                ->setCategory($this->getReference($faker->randomElement($categories)))
                ->setDuration($faker->numberBetween(10, 60));
                $manager->persist($recipes);
        }

        $manager->flush();
    }
    public function getDependencies(){
        //C'est pour donner un ordre de traitement des fixtures en cas
        //de dépendances des unes par rapport aux autres
        return [UserFixtures::class];
    }
}
