<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Common\Persistence\ObjectManager;

class ProfileFixture extends BaseFixture
{

    private static $avatars = [
        'user-01.jpg',
        'user-02.jpg',
        'user-03.jpg',
        'user-04.jpg',
        'user-05.jpg',
    ];

    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(10, 'profiles', function() use ($manager) {

            $profile = new Profile();
            $profile->setTwitterAccount($this->faker->url)
                ->setAvatarImageFileName($this->faker->randomElement(self::$avatars))
                ->setDescription($this->faker->paragraph)
                ->setFacebookAccount($this->faker->url)
                ->setInstagramAccount($this->faker->url)
                ->setSlackAccount($this->faker->url)
                ->setWebsiteUrl($this->faker->url)
                ->setYoutubeAccount($this->faker->url)
                ;

            $manager->persist($profile);

            return $profile;

        });

        $manager->flush();

    }


}
