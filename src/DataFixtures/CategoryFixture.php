<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'categories', function() use ($manager) {

            $category = new Category();
            $category->setName($this->faker->domainWord);

            $manager->persist($category);

            return $category;

        });

        $manager->flush();
    }


}
