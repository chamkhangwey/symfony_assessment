<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type = new Type();
        $type->setName('Home');
        $manager->persist($type);

        $type2 = new Type();
        $type2->setName('Work');
        $manager->persist($type2);

        $type3 = new Type();
        $type3->setName('Cellular');
        $manager->persist($type3);

        $type4 = new Type();
        $type4->setName('Other');
        $manager->persist($type4);

        $manager->flush();
    }
}
