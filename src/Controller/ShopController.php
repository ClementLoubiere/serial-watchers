<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShopController
 * @package App\Controller
 * @Route("/shop")
 */
class ShopController extends AbstractController
{

    /**
     * @Route("")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Product::class);

        $products = $repository->findBy([]);

        return $this->render(
            'shop/index.html.twig',
            [
                'products' => $products
            ]
        );
    }
}
