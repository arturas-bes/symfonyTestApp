<?php

namespace App\Tests;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    //    TEST IN ISOLATION CALL MANAGER AND ROOL BACK DB AFTER CHANGES
    private $entityManager;

    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();

        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');

        $this->entityManager->beginTransaction();
        $this->entityManager->getConnection()->setAutoCommit(false);
    }
    protected function tearDown()
    {
        $this->entityManager->rollback();
        $this->entityManager->close();
        $this->entityManager = null;
    }

//    public function testSomething()
//    {
////        COMMONLY USED ASSERTS
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/login');
////
////        $this->assertSame(200, $client->getResponse()->getStatusCode());
////        $this->assertContains('Hello', $crawler->filter('h1')->text());
////
////        $this->assertGreaterThan(
////            0,
////            $crawler->filter('html:contains("Hello")')->count()
////        );
////        $this->assertCount(1,$crawler->filter('h1'));
//
////        $this->asserttrue(
////            $client->getResponse()->headers->contains(
////                'Content-Type',
////                'application/json'
////            ),
////            'the "Content-Type" header is "application/json"' // optional message
////        );
////        $this->assertContains('foo', $client->getResponse()->getContent());
//
////        $this->assertRegExp('/foo(bar)?/', $client->getResponse()->getContent());
//
////        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
////        $this->assertTrue($client->getResponse()->isNotFound(), 'response status is 404');
////
////        $this->assertEquals(
////            200,
////            $client->getResponse()->getStatusCode()
////
////        );
////
////        $this->assertTrue(
////            $client->getResponse()->isRedirect('/demo/contact')
////        );
//
////        CLICK LINKS
//
////        $link = $crawler
////            ->filter('a:contains("ccccc auth")')
////            ->link();
////        $client->clickLink($link);
////        $this->assertContains('Remember me', $client->getResponse()->getContent());
//
//
////        CHECK FORMS
//
//        $form = $crawler->selectButton('Sign in')->form();
//        $form['email'] = 'admin@admin.com';
//        $form['password'] = 'password';
//
//        $crawler = $client->submit($form);
//        $crawler = $client->followRedirect();
//        $this->assertEquals(1, $crawler->filter('a:contains("Logout")')->count());
//    }


// DYNAMIC URLS
    /**
     * @param $url
     * @dataProvider provideUrls
     */
    public function testSomething($url)
    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', $url);
        $client = static::createClient();
        $crawler = $this->client->request('GET', $url);

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $video = $this->entityManager
            ->getRepository(Video::class)
            ->find(1);

        $this->entityManager->remove($video);
        $this->entityManager->flush();

        $this->assertNull($this->entityManager
            ->getRepository(Video::class)
            ->find(1)
        );

    }

    public function provideUrls()
    {
        ['/home', '/login'];
    }

//    TESTS IN ISOLATION
}
