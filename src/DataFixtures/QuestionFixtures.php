<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Question;
use App\Entity\User;
use Faker;

class QuestionFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');        
        $users = $manager->getRepository(User::class)->findAll();

        for ($i = 0; $i < 2; $i++) {
            $questionUser1 = new Question();
            $questionUser1->setTitle($faker->title);
            $questionUser1->setContent($faker->realText);
            $questionUser1->setUser($users[0]); 
            $manager->persist($questionUser1);
        }

        for ($i = 0; $i < 2; $i++) {
            $questionUser2 = new Question();
            $questionUser2->setTitle($faker->title);
            $questionUser2->setContent($faker->realText);
            $questionUser2->setUser($users[1]); 
            $manager->persist($questionUser2);
        }

        $manager->flush();
    }
    function getOrder()
    {
        return 2;
    }
}
