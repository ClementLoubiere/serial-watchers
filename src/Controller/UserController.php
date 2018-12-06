<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/gestion-user")
     */
    public function index()
    {
        return $this->render('gestion-user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
