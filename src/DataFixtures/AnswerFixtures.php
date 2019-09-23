<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Answer;
use App\Entity\Question;
use Faker;

class AnswerFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $questions = $manager->getRepository(Question::class)->findAll();

        for ($j = 0; $j < count($questions); $j++){
            for ($i = 0; $i < 2; $i++) {
                $answer = new Answer();
                $answer->setContent($faker->title);
                $answer->setStatus(($i==0?true:false)); 
                $answer->setQuestion($questions[$j]);
                $manager->persist($answer);
            }
        }
        $manager->flush();
    }

    function getOrder()
    {
        return 3;
    }
}