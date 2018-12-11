<?php

    namespace App\Controller;
    

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SeriesController extends AbstractController
{
    /**
     * @Route("/series/{id}")
     */
    public function stockIdApi($id)
    {
    
        //La clé API
        $api = "f9966f8cc78884142eed6c6d4710717a";
    
        // La taille de l'image
        $size = "w342";
        // concaténer avec l'url de l'image
        $baseURI = "http://image.tmdb.org/t/p/". $size;
    
        //appel à l'api
        $json = file_get_contents("https://api.themoviedb.org/3/tv/".$id."?api_key=".$api."&language=fr-FR");
    
        // convertit l'api de json en tableau
        $result = json_decode($json, true);
    
        // initialisation d'une variable tableau
        $tplArray = array();
    
        // boucle du nombre de résultat à partir de tableau $results à l'indice "results"
            // itération des différents indices qu'on va récupérer
            $tplArray[] = array(
                'id' => $result["id"],
                'name' => $result["original_name"],
                'description' => $result["overview"],
                'img' => $baseURI.$result["poster_path"]
            );
        
        
        return $this->render('series/index.html.twig',
            [
                'final' => $tplArray
            ]);
    }
}