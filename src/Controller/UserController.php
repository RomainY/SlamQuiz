<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/user")
*/

class UserController extends AbstractController {  
    
    /**
     * @Route("/index", name="user_index")
     */
    
    public function index () {

        $userlist = array();

        $userlist[0]['first_name'] = 'Richard';
        $userlist[0]['last_name'] = 'PASTEL';

        $userlist[1]['first_name'] = 'Jack';
        $userlist[1]['last_name'] = 'BOULON';
        
        return $this->render("user/user.html.twig", [
            'user_list' => $userlist,
        ]);

    }

}