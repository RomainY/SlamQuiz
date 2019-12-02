<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }
    
    /**
     * Login form show username, password and submit button
     */
    public function testShowLogin()
    {
        // Request /login 
        $crawler = $this->client->request('GET', '/login');

        // Asserts that /login path exists and don't return an error
        /* 
        Ecrire ici le code pour valider le succès de la réponse HTTP,
        c'est à dire affirmer que le code de statut de la réponse est égale à 200 (Response::HTTP_OK)
        */
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        
        // Asserts that the phrase "Log in!" is present in the page's title
        /* 
        Ecrire ici le code pour vérifier la présence de la phrase "Log in!" dans le titre de la page,
        c'est à dire affirmer qu'en parcourant le DOM, la balise 'html head title' contient 'Log in!'
        */ 
        
        $this->assertSelectorTextContains('html title', 'Log in!');
        // Asserts that the response content contains 'csrf token'
        /*
        Ecrire ici le code pour vérifier la présence du jeton csrf dans le contenu de la réponse HTTP  
        c'est à dire affirmer que le contenu de la réponse contient 'type="hidden" name="_csrf_token"'
        */

        $this->assertContains('type="hidden" name="_csrf_token"', $this->client->getResponse()->getContent());
        // Asserts that the response content contains 'input type="text" id="inputEmail"'
        /*
        Ecrire ici le code pour vérifier la présence du champ de formulaire email dans le contenu de la réponse HTTP  
        c'est à dire affirmer que le contenu de la réponse contient '<input type="email" value="" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>'
        */

        $this->assertContains('<input type="email" value="" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>', $this->client->getResponse()->getContent());
        // Asserts that the response content contains 'input type="text" id="inputPassword"'
        /*
        Ecrire ici le code pour vérifier la présence du champ de formulaire password dans le contenu de la réponse HTTP  
        c'est à dire affirmer que le contenu de la réponse contient '<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>'
        */
        $this->assertContains('<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>', $this->client->getResponse()->getContent());
    }

     /**
     * Verify that the category list is not displayed to users who do not have the admin role
     */
    public function testNotShowCategory()
    {
        // Request /category 
        $this->client->request('GET', '/category');

        // Asserts that category path move to another path (login)
        /* 
        Ecrire ici le code pour vérifier que, si l'utilisateur n'est pas connecté, 
        la requête '/category' renvoie vers une autre page (la page /login)
        c'est à dire affirmer que le code de statut de la réponse est égale à 301 (Response::HTTP_MOVED_PERMANENTLY)
        */
        $this->assertEquals(301, $this->client->getResponse()->getStatusCode());
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
        $crawler = $this->client->request('GET', '/category/');
        
        // Asserts that /category path exists and don't return an error
        /* 
        Ecrire ici le code pour vérifier que, si l'utilisateur est connecté avec le rôle ROLE_USER, 
        la requête '/category' renvoie une réponse HTTP avec un code de statut égale à 200 (Response::HTTP_OK)
        */
        
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        // Asserts that the response content contains 'Category index' in 'h1' tag
        /* 
        Ecrire ici le code pour vérifier que, si l'utilisateur est connecté avec le rôle ROLE_USER, 
        la requête '/category' renvoie 'Category index' dans la balise 'h1'
        */
        
        $crawler = $this->client->request('GET', '/category/new');

        // Asserts that /category/new path exists and don't return an error
        /* 
        Ecrire ici le code pour vérifier que, si l'utilisateur est connecté avec le rôle ROLE_USER, 
        la requête '/category/new' affiche que l'accès est interdit
        c'est à dire affirmer que le code de statut de la réponse est égale à 403 (Response::HTTP_FORBIDDEN)
        */
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Check the logged-on user's path access with the ROLE_ADMIN role
     */
    public function testSecuredRoleAdmin()
    {
        $this->logIn('Admin', 'ROLE_ADMIN');
        $crawler = $this->client->request('GET', '/category/new');

        // Asserts that /category/new path exists and don't return an error
        /* 
        Ecrire ici le code pour vérifier que, si l'utilisateur est connecté avec le rôle ROLE_ADMIN, 
        la requête '/category/new' renvoie une réponse HTTP avec un code de statut égale à 200 (Response::HTTP_OK)
        */
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        // Asserts that the response content contains 'Create new category' in 'h1' tag
        /* 
        Ecrire ici le code pour vérifier que, si l'utilisateur est connecté avec le rôle ROLE_ADMIN, 
        la requête '/category/new' renvoie 'Create new' dans la balise 'h1'
        */
        $this->assertSelectorTextContains('html h2', 'Create new');
    }
}
