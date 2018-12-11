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

        //$poster_path = $result["poster_path"];
        //$backdrop_path = $result["backdrop_path"];
        //$overview = $result["results"][0]["original_name"];
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

        return $this->render('user/dashboard/index.html.twig', array(
            'array' => $tplArray
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

}


