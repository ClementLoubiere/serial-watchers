<?php
/**
 * Created by PhpStorm.
 * User: julialuquot
 * Date: 2018-12-07
 * Time: 10:11
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index()
    {



        return $this->render('user/index.html.twig');

    }


}


