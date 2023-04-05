<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Entity\Filial;
use App\Entity\Transaction;
use Doctrine\Persistence\ObjectManager;

class TransactionFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager): void
    {
        $cardRepo = $manager->getRepository(Card::class);
        $cards = $cardRepo->findAll();

        $filialRepo = $manager->getRepository(Filial::class);
        $filials = $filialRepo->findAll();

        $trans = new Transaction();
        $trans->setFilial($this->faker->randomElement($filials))
            ->setCard($this->faker->randomElement($cards))
            ->setAmount($this->faker->randomNumber(3, false));

        $trans->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
        $trans->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));

        $manager->persist($trans);
        $manager->flush();
    }
}
