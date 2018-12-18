<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\Collection;

class SeriesController extends AbstractController
{
    //------------------- AFFICHAGE DES SERIES / FILTRES / PAGINATION ------------------//

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

        // page de résultat
        if ($request->query->has('page')) {
            $page = $request->query->get('page');
        } else {
            $page = 1;
        }

        // tri
        // Est-ce que l'url possède le champ sort_by qui permet de trier
        if ($request->query->has('sort_by')) {
            // si la requete vaut 'sort_by' alors elle récupère sa valeur dans le tableau
            $tri = $request->query->get('sort_by');

        } else {
            $tri = "popularity.desc";
        }

        // tri par année
        if ($request->query->has('first_air_date_year')) {
            $annee = $request->query->get('first_air_date_year');

        } else {
            $annee = "";
        }

        // tri par genres
        if ($request->query->has('with_genres')) {
            $genre = $request->query->get('with_genres');

        } else {
            $genre = "";
        }


        //appel à l'api
        $json = file_get_contents("https://api.themoviedb.org/3/discover/tv?api_key=".$api."&language=fr-FR&page=".$page.'&sort_by='.$tri."&first_air_date_year=".$annee."&with_genres=".$genre);


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

        //------------------- AJOUT DE SERIE DANS LA SECTION MES SERIES PAR L'UTILISATEUR ------------------//

        // Si notre formulaire est en POST
        if($request->isMethod('POST')) {

            // On va chercher l'utilisateur connecté
            $user = $this->getUser();

            // On appel l'entity manager
            $em = $this->getDoctrine()->getManager();

            // On instancie un nouvel objet Série
            $serie = new Serie();

            // On stock dans une variable la requête qui va rechercher le nom qui contient la valeur 'fav'
            $ajout = $request->request->get('fav');

            // On définit dans l'objet série l'utilisateur connecté et l'idApi à l'id de la série que l'utilisateur veut ajouter
            $serie
                ->setUser($user)
                ->setIdApi($ajout);

            // Recherche dans la table série une ligne qui combine l'idApi avec l'id du user connecté
            $repository = $em->getRepository(Serie::class);
            $doublon = $repository->findBy(['idApi' => $ajout, 'user' => $user]);

            //-------- Condition pour éviter les ajouts de doublon de série
            if(count($doublon) < 1 ) {

                // On enregistre en bdd l'objet série
                $em->persist($serie);
                $em->flush();

                // Message qui confirme que la série a bien été ajoutée
                $this->addFlash('success', 'Série ajoutée');
            } else {

                $this->addFlash('error', 'Vous avez déjà ajouter cette série');
            }
        }

        // appel des indices de tplArray dans test.twig
        return $this->render('series/index.html.twig', array(
            'array' => $tplArray,
            'page' => $page,
            'sort_by' => $tri,
            'year' => $annee,
            'genre' => $genre
        ));

    }

    //-------------------- PAGE DETAIL D'UNE SERIE --------------------//

    /**
     * @Route("/series/{id}/season/{season_number}", requirements={"id": "\d+", "season_number": "\d+"})
     */
    public function ficheSerie(Request $request, $id, $season_number)
    {
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
            'img' => $baseURI . $result["poster_path"],
        );

        // Boucle sur les saisons
        $nb_season = array();

        for ($j = 0; $j < count($result['seasons']); $j++) {
            $nb_season[] = array(
                'season' => $result["seasons"][$j]["season_number"]
            );
        }

        //Boucle sur le genre
        $nb_genre = array();

        for ($g = 0; $g < count($result["genres"]); $g++) {
            $nb_genre[] = array(
                'name' => $result["genres"][$g]["name"]
            );
        }



        //appel API pour récupérer la saison
        $episode = file_get_contents("https://api.themoviedb.org/3/tv/" . $id . "/season/" . $season_number . "?api_key=" . $api . "&language=fr-FR");

        $resultat = json_decode($episode, true);

        $nb_episode = array();

        // Boucle sur les épisodes
        for ($n = 0; $n < count($resultat["episodes"]); $n++) {
            $nb_episode[] = array(
                'id_episode' => $resultat["episodes"][$n]["id"],
                'name_episode' => $resultat["episodes"][$n]["name"],
                'num_episode' => $resultat["episodes"][$n]["episode_number"],
                'date_episode' => $resultat["episodes"][$n]["air_date"],
                'season_number' => $resultat["episodes"][$n]["season_number"]
            );
        }

        //------------------- CHECK D'UN EPISODE PAR L'UTILISATEUR ------------------//

        // Si notre formulaire est en POST
        if($request->isMethod('POST')) {


            // On instancie un nouvel objet Episode
            $addEpisode = new Episode();

            // On stock dans une variable la requête qui va rechercher le nom qui contient la valeur 'check'
            $ajoutEp = $request->request->get('check');

            // On définit dans l'objet episode l'utilisateur connecté et l'idEpisode à l'id de l'épisode que l'utilisateur veut cocher
            $addEpisode
                ->setUserEp($userEp)
                ->setIdEpisode($ajoutEp);

            // Recherche dans la table épisode une ligne qui combine l'idEpisode avec l'id du user connecté

            $doublonEp = $repository->findBy(['idEpisode' => $ajoutEp, 'UserEp' => $userEp]);

            //-------- Condition pour éviter les ajouts de doublon d'épisode
            if (count($doublonEp) < 1) {

                // On enregistre en bdd l'objet épsiode
                $em->persist($addEpisode);
                $em->flush();
            } else {
                $this->addFlash('error', 'Episode déjà coché');
            }
        }


        // On récupère l'id user de la table épisode
        $user_episodes = $repository->findBy(['UserEp' => $userEp]);

        $tab_user_episode = [];

        // Boucle sur chaque id user identique , on va chercher les id épisodes correspondant
        foreach ($user_episodes as $user_episode) {
            $tab_user_episode[] = $user_episode->getIdEpisode();
        }


        // appel des indices de tplArray dans test.twig
        return $this->render('series/serie.html.twig', array(
            'fiche' => $ficheArray,
            'nb_season' => $nb_season,
            'nb_genre' => $nb_genre,
            'episodes' => $nb_episode,
            'num_season' => $season_number,
            'tableau' => $tab_user_episode
        ));
    }

    //---------------- PAGE DES SERIES AJOUTEES PAR L'UTILISATEUR ------------//

    /**
     * @Route("/mesSeries")
     */
    public function afficherFav()
    {
        // on récupère l'utilisateur connecté
        $user = $this->getUser();
        
        // on va chercher dans la table Série les objets users afin de récupérer les Id API qui leur correspond
        $repository = $this->getDoctrine()->getRepository(Serie::class);
        $series = $repository->findBy(['user' => $user]);
        
        
        //La clé API
        $api = "f9966f8cc78884142eed6c6d4710717a";
    
        // La taille de l'image
        $size = "w342";
        // concaténer avec l'url de l'image
        $baseURI = "http://image.tmdb.org/t/p/". $size;
        
        // On initialise un tableau vide (json_data) et une variable i à 0
        $json_data = [];
        $i = 0;

        $nb_season = array();
        // Pour chaque série que le user a ajouter:
        foreach ($series as $idApi) {
            
            // on définie la variable var à l'id API de la série
            $var = $idApi->getIdApi();
    
            //appel à l'api
            $varApi = file_get_contents("https://api.themoviedb.org/3/tv/" . $var . "?api_key=" . $api . "&language=fr-FR");
            
            // on transforme l'appel api en tableau json
            $json_table = json_decode($varApi, true);
    
            // >On boucle nos différents éléments pour chaque série
            $json_data[$i]["id"] = $json_table['id'];
            $json_data[$i]["poster_path"] = $baseURI . $json_table['poster_path'];
            $json_data[$i]["original_name"] = $json_table['original_name'];
            $json_data[$i]["fav_id"] = $idApi->getId();
            $i++;

            $json = file_get_contents("https://api.themoviedb.org/3/tv/" . $var . "?api_key=" . $api . "&language=fr-FR");

            // convertit l'api de json en tableau
            $result = json_decode($json, true);

            for ($j = 0; $j < count($result['seasons']); $j++) {
                $nb_season[] = array(
                    'season' => $result["seasons"][$j]["season_number"]
                );
            }
        }


        return $this->render('series/mesSeries.html.twig',
            [
                'nb_season' => $nb_season,
                'json_data' => $json_data
            ]);
    }

    //------------ RETIRER UNE SERIE DE LA PAGE MES SERIES ---------//

    /**
     * @Route("/mesSeries/{id}")
     */
    public function retirerFav($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Serie::class);

        // on récupère la clé primaire de la table série
        $serie = $repository->find($id);

        // Si l'id que l'on cherche n'est pas null on retire la série
        if(!is_null($serie)){
            $em->remove($serie);
            $em->flush();

            // On affiche un message de confirmation à l'utilisateur
            $this->addFlash('success', 'Série supprimée');

            // On redirige sur l'onglet Mes Séries
            return $this->redirectToRoute('app_series_afficherfav');

        }
    }


}
