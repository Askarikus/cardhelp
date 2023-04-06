<?php

namespace App\DataFixtures;

use App\Entity\CardSettings;
use App\Entity\GroupClient;
use App\Enum\CardTypesEnum;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CardSettingsFixtures extends BaseFixtures implements OrderedFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        $groupClientRepo = $manager->getRepository(GroupClient::class);
        $groupClient = $groupClientRepo->findAll();


        $this->createMany(
            CardSettings::class,
            5,
            [$groupClient],
            function (CardSettings $settings, $arr) {
                $settings->setName($this->faker->word())
                    ->setType(CardTypesEnum::from($this->faker->randomElement(CardTypesEnum::values())))
                    ->setStep($this->faker->numberBetween(5, 10))
                    ->setGroupClient($this->faker->randomElement($arr[0]))
                    ->setDescription($this->faker->realText(rand(30, 80)));

                $settings->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $settings->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
            }
        );

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 3; // smaller means sooner
    }
}
