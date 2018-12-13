<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Entity\User;
use App\Form\SerieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\Collection;

class SeriesController extends AbstractController
{
    /**
     * @Route("/series")
     */
    public function api(Request $request)
    {
        //La clé API
        $api = "f9966f8cc78884142eed6c6d4710717a";

        // La taille de l'image
        $size = "w342";
        // concaténer avec l'url de l'image
        $baseURI = "http://image.tmdb.org/t/p/". $size;

        //appel à l'api
        $json = file_get_contents("https://api.themoviedb.org/3/tv/popular?api_key=".$api."&language=fr-FR&page=1");

        // convertit l'api de json en tableau
        $result = json_decode($json, true);

        // initialisation d'une variable tableau
        $tplArray = array();

        // boucle du nombre de résultat à partir de tableau $results à l'indice "results"
        for ($i = 0; $i < count($result['results']); $i++){
            // itération des différents indices qu'on va récupérer
            $tplArray[] = array(
                'id' => $result["results"][$i]["id"],
                'name' => $result["results"][$i]["original_name"],
                'datediff' => $result["results"][$i]["first_air_date"],
                'description' => $result["results"][$i]["overview"],
                'img' => $baseURI.$result["results"][$i]["poster_path"]
            );
        }

        /*
        // section enregistrement de l'id api avec l'utilisateur dans la bdd
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Serie::class);
    
    
        if($request->isMethod('POST')) {
        
            $favori = $request->request->get('test');
        
            $serie = new Serie();
        
            $serie->setIdApi($favori);
            
            $serie->setUsers($this->getUser());
            
            $em->persist($serie);
            $em->flush();
        
            $this->addFlash('success', 'La série a été ajoutée à "Mes séries"');
        } else {
            $this->addFlash('error', 'On a fait dla merde');
        }
        */
    
        if($request->isMethod('POST')) {
            /*if ($request->isXmlHttpRequest()) { */
        
            $user = $this->getUser();
        
            $em = $this->getDoctrine()->getManager();
        
            $serie = new Serie();
            $fun = $request->request->get('fav');
        
            $serie
                ->setUser($user)
                ->setIdApi($fun);
        
            $em->persist($serie);
            $em->flush();
        }

        // appel des indices de tplArray dans test.twig
        return $this->render('series/index.html.twig', array(
            'array' => $tplArray,
        ));

    }

    /**
     * @Route("/series/{id}", requirements={"id": "\d+"})
     */
    public function ficheSerie($id)
    {
        //La clé API
        $api = "f9966f8cc78884142eed6c6d4710717a";

        // La taille de l'image
        $size = "w342";
        // concaténer avec l'url de l'image
        $baseURI = "http://image.tmdb.org/t/p/" . $size;

        //appel à l'api
        $json = file_get_contents("https://api.themoviedb.org/3/tv/".$id."?api_key=".$api."&language=fr-FR");

        // convertit l'api de json en tableau
        $result = json_decode($json, true);

        // initialisation d'une variable tableau
        $ficheArray = array();

        // itération des différents indices qu'on va récupérer
        $ficheArray[] = array(
            'id_api' => $result["id"],
            'name' => $result["original_name"],
            'description' => $result["overview"],
            'network' => $result["networks"][0]["name"],
            'country' => $result["networks"][0]["origin_country"],
            'seasons' => $result["number_of_seasons"],
            'img' => $baseURI . $result["poster_path"]
        );

        $nb_season = array();

        for ($j = 0; $j < count($result['seasons']); $j++) {
            $nb_season[] = array(
                'season' => $result["seasons"][$j]["season_number"]
            );
        }

        $nb_genre = array();

        for ($g = 0; $g < count($result["genres"]); $g++) {
            $nb_genre[] = array(
                'name' => $result["genres"][$g]["name"]
            );
        }

        // appel des indices de tplArray dans test.twig
        return $this->render('series/serie.html.twig', array(
            'fiche' => $ficheArray,
            'nb_season' => $nb_season,
            'nb_genre' => $nb_genre
        ));
    }
    
    /**
     * @Route("/series")
     */
    public function ajoutFav(Request $request)
    {
       
       /* }
    
        return new JsonResponse(); */
        
    }
}
