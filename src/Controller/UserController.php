<?php
/**
 * Created by PhpStorm.
 * User: julialuquot
 * Date: 2018-12-07
 * Time: 10:11
 */

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
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
     * @Route("/")
     */
    public function index()
    {
        $api = "f9966f8cc78884142eed6c6d4710717a";

        $baseURI = "http://image.tmdb.org/t/p/";
        $size = "w342";

        $json = file_get_contents("https://api.themoviedb.org/3/tv/popular?api_key=" . $api . "&language=en-US&page=1");

        $result = json_decode($json, true);

        $tplArray = array();

        for ($i = 0; $i < count($result['results']); $i++) {
            $tplArray[] = array(
                'name' => $result["results"][$i]["original_name"],
                'datediff' => $result["results"][$i]["first_air_date"],
                'description' => $result["results"][$i]["overview"],
                'img' => $baseURI . $size . $result["results"][$i]["poster_path"],
                'genre' => $result["results"][$i]["genre_ids"]
            );
        }


        $json2 = file_get_contents("https://api.themoviedb.org/3/tv/latest?api_key=" . $api . "&language=fr-FR&page=1");

        $result2 = json_decode($json2, true);

        $tblArray2 = array();


        $tblArray2[] = array(
            'name' => $result2["original_name"],
            'datediff' => $result2["first_air_date"],
            'description' => $result2["next_episode_to_air"]["overview"],
            'country' => $result2["origin_country"],
            'nb_episodes' => $result2['number_of_episodes'],
            'nb_seasons' => $result2['number_of_seasons']
        );


        return $this->render('user/dashboard/index.html.twig', array(
            'array' => $tplArray,
            'array2' => $tblArray2
        ));


    }


    /**
     * @Route("/playlist")
     */
    public function playlist(Request $request)
    {

        //appel de l'entité manager
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository(Playlist::class);


        $playlists = $repository->findBy([], ['title' => 'asc']);


        //création du nouvel objet playlist
        $playlist = new playlist();
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //si mon form est valide à partir des annotation dans l'entité Catégory son ok
            if ($form->isValid()) {

                $playlist->setSerie();

                $em->persist($playlist);
                $em->flush();
                $this->addFlash('success', 'Votre playlist a bien été enregistré');

            }
        }


        return $this->render('user/dashboard/pages/playlists.html.twig', [
            'playlist' => $playlist,
            'playlists' => $playlists,
            'form' => $form->createView()
        ]);


    }

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
            'seasons' => $result2['number_of_seasons']
        );


    }

}


