<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Question;
use App\Entity\Answer;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        // POO
        $category1 = new Category();
        $category1->setShortname('POO');
        $category1->setLongname('Programmation Orientée Objet');
        $manager->persist($category1);

        // PHP
        $category2 = new Category();
        $category2->setShortname('PHP');
        $category2->setLongname('Langage PHP');
        $manager->persist($category2);

        // Symfony 4
        $category3 = new Category();
        $category3->setShortname('Symf4');
        $category3->setLongname('Symfony version 4');
        $manager->persist($category3);
        
        $manager->flush();


        //Question et réponses POO
        $question = new Question();
        $question->setText('blablaPOO1');

        $answer1 = new Answer();
        $answer1->setQuestion($question);
        $answer1->setText('réponsePOO1');
        $answer1->setCorrect(1);
        $manager->persist($answer1);
        $question->addAnswer($answer1);

        $answer2 = new Answer();
        $answer2->setQuestion($question);
        $answer2->setText('réponsePOO2');
        $answer2->setCorrect(0);
        $manager->persist($answer2);
        $question->addAnswer($answer2);

        $question->setCategory_id($category1);

        $manager->persist($question);
        
        //Question PHP
        
        
        $manager->flush();
    }
}
