<?php
/**
 * Created by PhpStorm.
 * User: julialuquot
 * Date: 2018-12-07
 * Time: 10:11
 */

namespace App\Controller;


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


//    FONCTION MISE A JOUR PROFIL
    /**
     * @Route("/update-user/{id}")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function updateUser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(User::class);
        // objet User dont l'id en bdd est celui reçu dans l'url
        $user = $repository->find($id);


        if ($request->isMethod('POST')) {
            $user
                ->setEmail($request->request->get('email'))
                ->setPseudo($request->request->get('pseudo'))
                ->setFirstname($request->request->get('firstname'))
                ->setLastname($request->request->get('lastname'))
                ->setBirthdate($request->request->get('birthdate'));

            //$emailDuForm = $request->request->get('email');
            //$user->setEmail($emailDuForm);

            $em->persist($user);
            $em->flush();
        }

        return $this->render(
            'user/dashboard/pages/update-user.html.twig', [
                'user' => $user
            ]
        );
    }


//    FONCTION NOUVEAUTES SERIES


    /**
     * @Route("/newSerie")
     */
    public function newSerie()
    {

        //pour appeler les nouvelles series:

        $api = "f9966f8cc78884142eed6c6d4710717a";


        $json = file_get_contents("https://api.themoviedb.org/3/tv/latest?api_key=" . $api . "&language=fr-FR&page=1");

        $result2 = json_decode($json, true);

        $tblArray2 = array();

        $tblArray2[] = array(
            'name' => $result2["original_name"],
            'datediff' => $result2["first_air_date"],
            'description' => $result2["next_episode_to_air"]["overview"],
            'country' => $result2["origin_country"],
            'episodes' => $result2['number_of_episodes'],
            'seasons' => $result2['number_of_seasons']);

        return $this->render(
            'user/series/newSeries.html.twig',

            [

                'array' => $tblArray2

            ]);

    }

    //    FONCTION PROCHINESSERIES
    public function nextSerie()
    {


        //pour appeler les nouvelles series:

        $api = "f9966f8cc78884142eed6c6d4710717a";

        $json = file_get_contents("https://api.themoviedb.org/3/tv/on_the_air?api_key=" . $api . "&language=fr-FR&page=1");

        $result3 = json_decode($json, true);

        $tblArray3 = array();

        $tblArray3[] = array(
            'id' => $result3["id"],
            'name' => $result3["original_name"],
            'datediff' => $result3["first_air_date"],
            'description' => $result3["next_episode_to_air"]["overview"],
            'country' => $result3["origin_country"],
            'episodes' => $result3['number_of_episodes'],
            'seasons' => $result3['number_of_seasons']);

        return $this->render(
            'user/series/nextSeries.html.twig',

            [

                'array' => $tblArray3

            ]);

    }




}







