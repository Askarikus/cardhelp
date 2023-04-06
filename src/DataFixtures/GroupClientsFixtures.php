<?php

namespace App\DataFixtures;

use App\Entity\GroupClient;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;

class GroupClientsFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $projectRepo = $manager->getRepository(Project::class);
        $projects = $projectRepo->findAll();


        $this->createMany(
            GroupClient::class,
            12,
            [$projects],
            function (GroupClient $clientGroup, $arr) {
                $clientGroup->setName($this->faker->word())
                    ->setProject($this->faker->randomElement($arr[0]));
                $clientGroup->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $clientGroup->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));
            }
        );

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 2; // smaller means sooner
    }
}
