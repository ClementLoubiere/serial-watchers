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


    public function editProfil(Request $request, $id)
    {


        //Création de l'entité Manager:

        $em = $this->getDoctrine()->getManager();
        // Appel de la class utilisateur:

        $repository = $em->getRepository(User::class);

        $profil = null;


        //création :

        if (is_null($id)) {

            $profil = $this->getUser();


        }


        return $this->render('user/profil.html.twig', [

            'profil' => $profil

        ]);


    }


    //fonction liste serie
    public function mesListes(Serie $serie)
    {


        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Serie::class);
        $serie = $repository->findBy([], [
            'id'=>]);

        //création liste series utilisateur


        // modification liste series utilisateur


        //suppression listes series utilisateur


    }


    //fonction suivi serie


    //fonction abonnement

return $this->render('user/profil.html.twig', [

'series' => $series

]);
}



