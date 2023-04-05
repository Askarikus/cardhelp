<?php

namespace App\DataFixtures;

use App\Entity\Filial;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;

class FilialFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $projectRepo = $manager->getRepository(Project::class);
        $projects = $projectRepo->findAll();

        $filial = new Filial();
        $filial->setName($this->faker->company())
            ->setProject($this->faker->randomElement($projects))
            ->setDescription($this->faker->realText(rand(30, 80)));
        $filial->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        $filial->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));

        $manager->persist($filial);
        $manager->flush();
    }
}
