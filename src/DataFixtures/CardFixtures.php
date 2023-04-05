<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Project;
use App\Entity\Card;
use App\Entity\CardSettings;
use App\Enum\CardTypesEnum;
use Doctrine\Persistence\ObjectManager;

class CardFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $projectRepo = $manager->getRepository(Project::class);
        $projects = $projectRepo->findAll();

        $settingsRepo = $manager->getRepository(CardSettings::class);
        $settingss = $settingsRepo->findAll();


        // $settings = new CardSettings();
        // $settings->setName($this->faker->word())
        //     ->setType(CardTypesEnum::from($this->faker->randomElement(CardTypesEnum::values())))
        //     ->setStep($this->faker->numberBetween(5, 10))
        //     ->setProject($this->faker->randomElement($projects))
        //     ->setDescription($this->faker->realText(rand(30, 80)));

        // $settings->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        // $settings->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));

        $clientRepo = $manager->getRepository(Client::class);
        $clients = $clientRepo->findAll();

        // $client = new Client();
        // $client->setName($this->faker->name())
        //     ->setProject($this->faker->randomElement($projects))
        //     ->setPhone($this->faker->phoneNumber())
        //     ->setBirthday(new \DateTimeImmutable($this->faker->date()));

        // $client->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        // $client->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));


        $card = new Card();
        $card->setClient($this->faker->randomElement($clients))
            ->setSettings($this->faker->randomElement($settingss))
            ->setAmount($this->faker->randomNumber(4, true));

        $card->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        $card->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));


        $manager->persist($card);
        // $manager->persist($settings);
        // $manager->persist($client);
        // $manager->persist($project);
        $manager->flush();
    }
}
