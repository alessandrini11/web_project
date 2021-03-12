<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login():Response
    {
        return $this->render('account/login.html.twig');
    }

    /**
     * @Route("/logout",name="logout")
     */
    public function logout(){

    }
}
