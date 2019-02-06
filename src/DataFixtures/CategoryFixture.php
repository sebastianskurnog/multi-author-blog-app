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
            $category->setName($this->faker->domainWord)
                ->setDescription($this->faker->paragraph);

            $manager->persist($category);

            return $category;

        });

        $manager->flush();
    }


}
