<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    /**
     * @Route("/gestion_series", name="gestion_series")
     */
    public function index()
    {
        return $this->render('gestion_series/index.html.twig', [
            'controller_name' => 'SeriesController',
        ]);
    }
}
