<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departements = ['Direction', 'RH', 'Communication', 'Développement'];

        foreach ($departements as $departement) {
            $dep = new Departement();
            $dep->setName($departement);
            $dep->setManagerMail('manager@' . strtolower($departement) . '.com');
            $manager->persist($dep);
        }

        $manager->flush();
    }
}
