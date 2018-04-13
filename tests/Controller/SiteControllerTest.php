<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SiteControllerTest extends WebTestCase
{
    public function testShowHome()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowRegistration()
    {
        $client = static::createClient();
        $client->request('GET', '/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowLogin()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowSuccessAuth()
    {
        $client = static::createClient();
        $client->request('GET', '/successAuth');
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    public function testShowStat()
    {
        $client = static::createClient();
        $client->request('GET', '/stat');
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    public function testShowLogout()
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $this->assertTrue($client->getResponse()->isRedirect());
    }
}