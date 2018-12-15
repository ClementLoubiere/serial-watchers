<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {


        /*** POPULAR SERIES */

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


        /*** LAST SERIES */

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


        return $this->render('index/index.html.twig', array(
            'array' => $tplArray,
            'array2' => $tblArray2
        ));


    }


}








