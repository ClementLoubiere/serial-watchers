<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/gestion_user", name="gestion_user")
     */
    public function index()
    {
        return $this->render('gestion_user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
