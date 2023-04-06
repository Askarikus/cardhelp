<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ProjectFixtures extends BaseFixtures implements OrderedFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(
            Project::class,
            6,
            [],
            function (Project $project, $arr) {
                $project->setName($this->faker->company());
                $project->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $project->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
            }
        );
        $this->manager->flush();
    }

    public function getOrder(): int
    {
        return 1; // smaller means sooner
    }
}
