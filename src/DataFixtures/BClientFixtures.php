<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;

class BClientFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        // $project = new Project();
        // $project->setName($this->faker->company());
        // $project->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        // $project->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        $projectRepo = $manager->getRepository(Project::class);
        $projects = $projectRepo->findAll();


        $client = new Client();
        $client->setName($this->faker->name())
            ->setProject($this->faker->randomElement($projects))
            ->setPhone($this->faker->phoneNumber())
            ->setBirthday(new \DateTimeImmutable($this->faker->date()));
        $client->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        $client->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));


        $manager->persist($client);
        // $manager->persist($project);
        $manager->flush();
    }
}
