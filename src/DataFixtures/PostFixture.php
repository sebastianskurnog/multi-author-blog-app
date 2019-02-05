<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixture extends BaseFixture implements DependentFixtureInterface
{

    private static $postImageThumbs = [
        'tulips-800.jpg',
        'watch-800.jpg',
        'woodcraft-800.jpg',
        'music-800.jpg',
        'lamp-800.jpg',
        'guitarist-800.jpg',
        'flowers-800.jpg',
        'beetle-800.jpg'
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(50, 'posts', function () use ($manager) {

            $post = new Post();
            $post->setTitle($this->faker->sentence)
                ->setBody($this->faker->paragraph)
                ->setMainImageFilename($this->faker->randomElement(self::$postImageThumbs))
                ->setPostType('standard')
                ->setUser($this->getRandomReference('users'))
                ->setCategory($this->getRandomReference('categories'))
                ->addTag($this->getRandomReference('tags'))
                ->setIsPromoted($this->faker->boolean(5))
                ->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'))
                ->setIsActive($this->faker->boolean(80))
                ;

            $manager->persist($post);

            return $post;

        });

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
            CategoryFixture::class,
            TagFixture::class
        ];
    }


}
