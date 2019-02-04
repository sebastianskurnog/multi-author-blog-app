<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixture extends BaseFixture
{

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(20, 'tags', function() use ($manager) {

            $tag = new Tag();
            $tag->setName($this->faker->word);

            $manager->persist($tag);

            return $tag;
        });

        $manager->flush();
    }


}
