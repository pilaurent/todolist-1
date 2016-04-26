<?php

namespace TodoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TodoBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('test');
        $userAdmin->setEmail('test@test.fr');
        $userAdmin->setName('Admin');

        $manager->persist($userAdmin);
        $manager->flush();
    }
}
