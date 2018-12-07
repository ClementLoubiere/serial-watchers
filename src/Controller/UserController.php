<?php
/**
 * Created by PhpStorm.
 * User: julialuquot
 * Date: 2018-12-07
 * Time: 10:11
 */

namespace App\Controller;

use App\Entity\Serie;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{

    /**
     * @Route("/{id}")
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(User::class);
        $user = $repository->findBy([], [
            'user' => $user
        ]);


        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }


    // FONCTION EDITION PROFIL

    /**
     * @Route("/profil")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function profil()
    {




        return $this->render('profil.html.twig', [


        ]);


    }


    //fonction liste serie


        //création liste series utilisateur


        // modification liste series utilisateur


        //suppression listes series utilisateur





    //fonction suivi serie


    //fonction abonnement


}



