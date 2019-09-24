<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $category1 = new Category();
        $category1->setName('Ressources humaines');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Communication');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Direction');
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Commerce');
        $manager->persist($category4);

        $manager->flush();
    }


}
