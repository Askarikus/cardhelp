<?php

namespace App\DataFixtures;

use App\Entity\CardSettings;
use App\Entity\Project;
use App\Enum\CardTypesEnum;
use Doctrine\Persistence\ObjectManager;

class BCardSettingsFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $projectRepo = $manager->getRepository(Project::class);
        $projects = $projectRepo->findAll();

        $this->createMany(
            CardSettings::class,
            5,
            [$projects],
            function (CardSettings $settings, $arr) {
                $settings->setName($this->faker->word())
                    ->setType(CardTypesEnum::from($this->faker->randomElement(CardTypesEnum::values())))
                    ->setStep($this->faker->numberBetween(5, 10))
                    ->setProject($this->faker->randomElement($arr[0]))
                    ->setDescription($this->faker->realText(rand(30, 80)));

                $settings->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $settings->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
            }
        );

        $manager->flush();
    }
}
