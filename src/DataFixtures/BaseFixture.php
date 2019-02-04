<?php
/**
 * Created by PhpStorm.
 * User: seboslaw
 * Date: 04.02.19
 * Time: 14:35
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{

    /** @var Generator */
    protected $faker;

    private $referencesIndex = [];

    // list of references that is already in use
    private $usedReferencesIndex = [];


    public function load(ObjectManager $manager)
    {
        // create faker generator
        $this->faker = Factory::create();

        // execute method from classes that extends this abstract class
        $this->loadData($manager);
    }

    abstract protected function loadData(ObjectManager $manager);


    protected function createMany(int $count, string $groupName, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = $factory();
            if (null === $entity) {
                throw new \LogicException('Callback function must return entity object');
            }
            // store for usage later as groupName_#COUNT#
            $this->addReference(sprintf('%s_%d', $groupName, $i), $entity);
        }
    }

    protected function getRandomReference(string $className, bool $onlyUnique = false) {
        if (!isset($this->referencesIndex[$className])) {
            $this->referencesIndex[$className] = [];
            foreach ($this->referenceRepository->getReferences() as $key => $ref) {
                if (strpos($key, $className.'_') === 0) {
                    $this->referencesIndex[$className][] = $key;
                }
            }
        }
        if (empty($this->referencesIndex[$className])) {
            throw new \Exception(sprintf('Cannot find any references for class "%s"', $className));
        }

        $randomReferenceKey = $this->faker->randomElement($this->referencesIndex[$className]);

        // search only for unique reference (eg. for one to one relations)
        if($onlyUnique) {
            // search for random reference until it's unique
            while (in_array($randomReferenceKey, $this->usedReferencesIndex)) {
                $randomReferenceKey = $this->faker->randomElement($this->referencesIndex[$className]);
            }
            // add used reference to list
            $this->usedReferencesIndex[] = $randomReferenceKey;
        }

        return $this->getReference($randomReferenceKey);
    }


}