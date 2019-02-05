<?php
/**
 * Created by PhpStorm.
 * User: seboslaw
 * Date: 05.02.19
 * Time: 17:03
 */

namespace App\Tests\Controller;


use App\DataFixtures\CategoryFixture;
use App\DataFixtures\PostFixture;
use App\DataFixtures\ProfileFixture;
use App\DataFixtures\TagFixture;
use App\DataFixtures\UserFixture;
use App\Entity\Post;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{


    /**
     * Fill database with data from data fixtures classes
     */
    public function setUp()
    {
        $this->loadFixtures([
           UserFixture::class,
           CategoryFixture::class,
           TagFixture::class,
           PostFixture::class,
           ProfileFixture::class
        ]);

    }

    /**
     * Get entity manager from the container
     *
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getEntityManager()
    {
        $container = self::$container;
        $entityManager = $container->get('doctrine')->getManager();

        return $entityManager;
    }


    /**
     * Test checks if 2 sets of data (promoted posts & all posts) are shown on homepage
     */
    public function testPostsAreShownOnHomePage()
    {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/');

        // get number of promoted posts from data fixture class
        $promotedPostsCount = PostFixture::$numberOfPromotedPosts;

        // get count of all published posts
        $allPublishedPostsCount = count($this->getEntityManager()->getRepository(Post::class)->findAllPublishedOrderedByNewest());

        // check status code
        $this->assertStatusCode(200, $client);

        // check if promoted posts count is equal to posts viewed on homepage
        $this->assertCount($promotedPostsCount, $crawler->filter('.featured__slide'));

        // check if count posts is equal to posts viewed on homepage
        $this->assertCount($allPublishedPostsCount, $crawler->filter('.item-entry'));

    }

    /**
     * Delete all data from database
     */
    public function tearDown()
    {
        $purger = new ORMPurger($this->getEntityManager());
        $purger->purge();
    }

}