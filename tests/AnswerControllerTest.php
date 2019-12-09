<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AnswerControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }
    
    public function testShowLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        
        $this->assertSelectorTextContains('html title', 'Log in!');

        $this->assertContains('type="hidden" name="_csrf_token"', $this->client->getResponse()->getContent());

        $this->assertContains('<input type="email" value="" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>', $this->client->getResponse()->getContent());

        $this->assertContains('<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>', $this->client->getResponse()->getContent());
    }

    public function testNotShowAnswer()
    {
        $this->client->request('GET', '/answer');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    private function logIn($userName , $userRole)
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'main';

        $firewallContext = 'main';

        $token = new UsernamePasswordToken($userName, null, $firewallName, [$userRole]);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    public function testSecuredRoleUser()
    {
        $this->logIn('User', 'ROLE_USER');
        $crawler = $this->client->request('GET', '/answer/');
        
        $this->assertEquals(Response::HTTP_FORBIDDEN, $this->client->getResponse()->getStatusCode());
        
        $crawler = $this->client->request('GET', '/answer/new');

        $this->assertEquals(403, $this->client->getResponse()->getStatusCode());
    }

    public function testSecuredRoleAdmin()
    {
        $this->logIn('Admin', 'ROLE_ADMIN');
        $crawler = $this->client->request('GET', '/answer/new');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        //$this->assertSelectorTextContains('html h2', 'Create new'); //prob->translate
    }
}
