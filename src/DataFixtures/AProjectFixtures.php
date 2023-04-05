<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;

class AProjectFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $project = new Project();
        $project->setName($this->faker->company());
        $project->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        $project->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));


        $this->manager->persist($project);
        $this->manager->flush();
    }
}