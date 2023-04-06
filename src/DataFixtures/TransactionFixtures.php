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

        $this->createMany(
            Transaction::class,
            50,
            [$cards, $filials],
            function (Transaction $trans, $arr) {
                $trans->setCard($this->faker->randomElement($arr[0]))
                    ->setFilial($this->faker->randomElement($arr[1]))
                    ->setAmount($this->faker->randomNumber(3, false));

                $trans->setCreatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days')));
                $trans->setUpdatedAt(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-50 days')));
            }
        );

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 5; // smaller means sooner
    }
}
