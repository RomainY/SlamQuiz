<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class QuestionControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }
    
    private function logIn($userName , $userRole)
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'main';
        // if you don't define multiple connected firewalls, the context defaults to the firewall name
        // See https://symfony.com/doc/current/reference/configuration/security.html#firewall-context
        $firewallContext = 'main';

        // you may need to use a different token class depending on your application.
        // for example, when using Guard authentication you must instantiate PostAuthenticationGuardToken
        $token = new UsernamePasswordToken($userName, null, $firewallName, [$userRole]);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
    
    /**
     * Check the logged-on user's path access with the ROLE_USER role
     */
    public function testSecuredRoleUser()
    {
        $this->logIn('User', 'ROLE_USER');
        $crawler = $this->client->request('GET', '/question/');
        
        // Asserts that /question path exists and don't return an error
        
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode());
        // Asserts that the response content contains 'Category index' in 'h1' tag
        
        $crawler = $this->client->request('GET', '/question/2/new');

        // Asserts that /question/2/new path exists and don't return an error
        
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Check the logged-on user's path access with the ROLE_ADMIN role
     */
    public function testSecuredRoleAdmin()
    {
        $this->logIn('admin', 'ROLE_ADMIN');
        $crawler = $this->client->request('GET', '/question/2/new');

        // Asserts that /question/new path exists and don't return an error
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        
        // Asserts that the response content contains 'Create new question' in 'h1' tag
        
    }
}
