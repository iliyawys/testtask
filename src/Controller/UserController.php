<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route("/login, name="user_login"")
     */
    public function loginAction()
    {
        return new Response("login");
    }

    /**
     * @Route("/statistics")
     */
    public function statisticsAction()
    {
       return new Response(
            'statistics'
        );
    }
}