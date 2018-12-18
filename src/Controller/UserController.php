<?php
/**
 * Created by PhpStorm.
 * User: julialuquot
 * Date: 2018-12-07
 * Time: 10:11
 */

namespace App\Controller;


use App\Entity\Episode;
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
     * @Route("/dashboard")
     */
    public function dashboard()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->findBy([], ['firstname' => 'asc']);


        // On va chercher l'utilisateur connecté
        $userEp = $this->getUser();

        // On appel l'entity manager
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Episode::class);

        //La clé API
        $api = "f9966f8cc78884142eed6c6d4710717a";

        // La taille de l'image
        $size = "w342";
        // concaténer avec l'url de l'image
        $baseURI = "http://image.tmdb.org/t/p/" . $size;

        //appel à l'api
        $json = file_get_contents("https://api.themoviedb.org/3/tv/airing_today?api_key=" . $api . "&language=en-US&page=1");


        // convertit l'api de json en tableau
        $result = json_decode($json, true);

        // initialisation d'une variable tableau
        $ficheArray = array();

        // itération des différents indices qu'on va récupérer
        for ($i = 0; $i < count($result['results']); $i++) {
            // itération des différents indices qu'on va récupérer
            $ficheArray[] = array(
                'id' => $result["results"][$i]["id"],
                'name' => $result["results"][$i]["original_name"],
                'datediff' => $result["results"][$i]["first_air_date"],
                'description' => $result["results"][$i]["overview"],
            );

        }

        // appel des indices de tplArray dans test.twig
        return $this->render('user/dashboard.html.twig', array(
            'fiche' => $ficheArray,
            'user' => $user
        ));

    }



//    FONCTION MISE A JOUR PROFIL

    /**
     * @Route("/update-user")
     */

    public function updateUser(Request $request)
    {
        $id = $this->getUser();

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
            'user/profil/update-user.html.twig', [
                'user' => $user
            ]
        );
    }

//    FONCTION NOUVEAUTES SERIES


    /**
     * @Route("/newseries")
     */
    public function newSerie()
    {

        //pour appeler les nouvelles series:

        $api = "f9966f8cc78884142eed6c6d4710717a";

        $json = file_get_contents("https://api.themoviedb.org/3/tv/latest?api_key=" . $api . "&language=fr-FR&page=1");

        $result2 = json_decode($json, true);

        $SerieNew = array();

        $SerieNew[] = array(
            'name' => $result2["original_name"],
            'datediff' => $result2["first_air_date"],
            'description' => $result2["next_episode_to_air"]["overview"],
            'country' => $result2["origin_country"],
            'episodes' => $result2['number_of_episodes'],
            'seasons' => $result2['number_of_seasons']
        );


        return $this->render(
            'user/series/newSeries.html.twig',
            [
                'new' => $SerieNew
            ]);

    }

    //    FONCTION PROCHAINES SERIES


    /**
     * @Route("/nextseries")
     */
    public function nextSeries()
    {

        //pour appeler les nouvelles series:

        $api = "f9966f8cc78884142eed6c6d4710717a";

        $size = "w342";
        $baseURI = 'http://image.tmdb.org/t/p/' . $size;

        $json = file_get_contents("https://api.themoviedb.org/3/tv/on_the_air?api_key=" . $api . "&language=fr-FR&page=1");

        $result3 = json_decode($json, true);

        $SerieNext = array();

        for ($i = 0; $i < count($result3['results']); $i++) {
            $SerieNext[] = array(
                'id' => $result3['results'][$i]["id"],
                'img' => $baseURI . $result3['results'][$i]['poster_path'],
                'name' => $result3['results'][$i]["original_name"],
                'datediff' => $result3['results'][$i]["first_air_date"],
                'description' => $result3['results'][$i]["overview"],
                'country' => $result3['results'][$i]["origin_country"],
            );
        }


        return $this->render(
            'user/series/nextSeries.html.twig',
            [
                'next' => $SerieNext
            ]);
    }

}







