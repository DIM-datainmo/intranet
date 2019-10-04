<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $userRepo = $manager->getRepository(User::class);
        $user = $userRepo->findOneUser();

        $faker = Factory::create('fr_FR');
        $startDate = $faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        for($i = 0; $i < 20; $i++){
            $event = new Event();
            $event->setName($faker->words(3,true))
                ->setDescription($faker->text(1000))
                ->setIsPublished(true)
                ->setLocation($faker->city);
            $event->setStartDate($startDate);
            $event->setEndDate($faker->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s').' +2 days'));

            $event->setAuthor($user);

            $manager->persist($event);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
