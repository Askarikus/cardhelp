<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;

class BClientFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $projectRepo = $manager->getRepository(Project::class);
        $projects = $projectRepo->findAll();

        $this->createMany(
            Client::class,
            12,
            [$projects],
            function (Client $client, $arr) {
                $client->setName($this->faker->name())
                    ->setProject($this->faker->randomElement($arr[0]))
                    ->setPhone($this->faker->e164PhoneNumber())
                    ->setBirthday(new \DateTimeImmutable($this->faker->date()));
                $client->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $client->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));
            }
        );

        $manager->flush();
    }
}
