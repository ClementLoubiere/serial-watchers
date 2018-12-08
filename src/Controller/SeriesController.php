<?php

namespace App\Controller;

use App\Entity\Serie;
use http\Env\Request;
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


        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Serie::class);
        $series = $repository->findBy([], ['name' => 'asc']);


        return $this->render('user/series/index.html.twig', [

            'series' => $series

        ]);

    }




}
