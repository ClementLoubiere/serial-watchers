<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/detail-produit")
 *
 */
class ProductController extends AbstractController
{
    /**
     * @Route("")
     */
    public function index()
    {
        return $this->render(
            'product/index.html.twig',
            [

            ]
        );
    }
}
