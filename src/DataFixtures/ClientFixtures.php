<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\GroupClient;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $groupClientRepo = $manager->getRepository(GroupClient::class);
        $groupClient = $groupClientRepo->findAll();

        $this->createMany(
            Client::class,
            12,
            [$groupClient],
            function (Client $client, $arr) {
                $client->setName($this->faker->name())
                    ->setGroupClient($this->faker->randomElement($arr[0]))
                    ->setPhone($this->faker->e164PhoneNumber())
                    ->setBirthday(new \DateTimeImmutable($this->faker->date()));
                $client->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $client->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));
            }
        );

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 3; // smaller means sooner
    }
}
