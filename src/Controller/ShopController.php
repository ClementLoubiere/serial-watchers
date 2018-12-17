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

        $products = $repository->findBy([], ['title' => 'asc'] );

        return $this->render(
            'shop/index.html.twig',
            [
                'products' => $products
            ]
        );
    }

    /**
     * @Route("/coffret")
     */
    public function coffret()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        $products = $repository->findBy(['category' => 'Coffret série'], ['title' => 'asc']);

        return $this->render(
            'shop/coffret.html.twig',
            [
                'products' => $products
            ]
        );
    }

    /**
     * @Route("/dvd")
     */
    public function dvd()
    {

        $repository = $this->getDoctrine()->getRepository(Product::class);

        $products = $repository->findBy(['category' => 'DVD & Blue-ray'], ['title' => 'asc']);

        return $this->render(
            'shop/dvd.html.twig',
            [
                'products' => $products
            ]
        );
    }

    /**
     * @Route("/goodies")
     */
    public function goodies()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        $products = $repository->findBy(['category' => 'Goodies'], ['title' => 'asc']);

        return $this->render(
            'shop/goodies.html.twig',
            [
                'products' => $products
            ]
        );
    }
}
