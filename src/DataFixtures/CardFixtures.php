<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Card;
use App\Entity\CardSettings;
use Doctrine\Persistence\ObjectManager;

class CardFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $clientRepo = $manager->getRepository(Client::class);
        $clients = $clientRepo->findAll();

        $settingsRepo = $manager->getRepository(CardSettings::class);
        $settingss = $settingsRepo->findAll();

        $this->createMany(
            Card::class,
            15,
            [$clients, $settingss],
            function (Card $card, $arr) {
                $card->setClient($this->faker->randomElement($arr[0]))
                    ->setSettings($this->faker->randomElement($arr[1]))
                    ->setAmount($this->faker->randomNumber(4, true));

                $card->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $card->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));
            }
        );

        $manager->flush();
    }
}
