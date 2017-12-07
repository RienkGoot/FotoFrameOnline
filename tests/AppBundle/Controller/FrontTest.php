<?php
/**
 * Created by PhpStorm.
 * User: Rienk
 * Date: 7-12-2017
 * Time: 21:16
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\FrontController;

/**
 * Class FrontTest
 * Test the routes
 * @package Tests\AppBundle\Controller
 */
class FrontTest extends \PHPUnit_Framework_TestCase
{
    private $client = null;

    /**
     * Set up the client
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Test route /
     */
    public function testIndexAction()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test route /subcategorie
     */
    public function testCatAction()
    {
        $crawler = $this->client->request('GET', '/subcategorie');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test route /frames
     */
    public function testSubAction()
    {
        $crawler = $this->client->request('GET', '/frames');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test route /frame
     */
    public function testFrameAction()
    {
        $crawler = $this->client->request('GET', '/frame');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
