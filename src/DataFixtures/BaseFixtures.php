<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

abstract class BaseFixtures extends Fixture
{
    /**@var ObjectManager */
    protected $manager;
    protected $faker;

    abstract protected function loadData(ObjectManager $em);

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->faker = Factory::create('ru_RU');

        $this->loadData($manager);

        // for ($i=0; $i<7 ; $i++) {
        //     $this->loadData($manager);
        // }
    }

    protected function createMany(string $classname, int $count, array $args, callable $factory)
    {
        for ($i=0; $i<$count ; $i++) {
            $entity = new $classname();
            $factory($entity, $args);

            $this->manager->persist($entity);
            // $this->addReference($classname.'_'.$i, $entity);
        }
    }
}
