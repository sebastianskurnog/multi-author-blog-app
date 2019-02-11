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

    public static $numberOfPromotedPosts = 3;

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(50, 'posts', function () use ($manager) {

            $post = new Post();
            $post->setTitle($this->faker->sentence)
                ->setBody($this->faker->paragraphs(15, true))
                ->setMainImageFilename($this->faker->randomElement(self::$postImageThumbs))
                ->setPostType('standard')
                ->setUser($this->getRandomReference('users'))
                ->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'))
                ->setIsActive($this->faker->boolean(80))
                ;

                $randomNumber = rand(1, 4);

                for($ii = 0; $ii < $randomNumber; $ii++) {
                    $post->addCategory($this->getRandomReference('categories'))
                        ->addTag($this->getRandomReference('tags'));
                }




            $manager->persist($post);

            return $post;

        });


        $manager->flush();

        $this->promotePosts($manager);
    }

    /**
     * Promote random posts (promoted posts are displayed in feature section on homepage
     *
     * @param ObjectManager $manager
     * @throws \Exception
     */
    protected function promotePosts(ObjectManager $manager): void
    {
        for($i = 0; $i < self::$numberOfPromotedPosts; $i++) {
            /** @var Post $post */
            $post = $this->getRandomReference('posts', true);
            $post->setIsPromoted(true)
                ->setIsActive(true);

            $manager->persist($post);
        }

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
