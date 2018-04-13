<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testShowStat()
    {
        $client = static::createClient();
        $client->request('GET', '/stat');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testShowLogout()
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}