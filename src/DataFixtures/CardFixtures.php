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
        $settingsRepo = $manager->getRepository(CardSettings::class);
        $settingss = $settingsRepo->findAll();

        $clientRepo = $manager->getRepository(Client::class);
        $clients = $clientRepo->findAll();

        $card = new Card();
        $card->setClient($this->faker->randomElement($clients))
            ->setSettings($this->faker->randomElement($settingss))
            ->setAmount($this->faker->randomNumber(4, true));

        $card->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        $card->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));

        $manager->persist($card);
        $manager->flush();
    }
}
