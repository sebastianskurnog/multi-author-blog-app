<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends BaseFixture implements DependentFixtureInterface
{

    public function loadData(ObjectManager $manager)
    {

        $this->createMany(10, 'users', function() use ($manager) {

            $user = new User();
            $user->setEmail($this->faker->email)
                ->setUserName($this->faker->userName)
                ->setPassword('password')
                ->setAgreeTermsAt(new \DateTime())
                ->setProfile($this->getRandomReference('profiles', true))
                ;

            $manager->persist($user);

            return $user;

        });

        $manager->flush();


    }

    public function getDependencies()
    {
        return [
            ProfileFixture::class
        ];
    }


}
