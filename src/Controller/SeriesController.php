<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SeriesController
 * @package App\Controller
 * @Route("/series")
 */
class SeriesController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('gestion-series/index.html.twig', [
            'controller_name' => 'SeriesController',
        ]);
    }
}
