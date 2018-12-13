<?php
/**
 * Created by PhpStorm.
 * User: julialuquot
 * Date: 2018-12-07
 * Time: 10:11
 */

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\User;
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


        /*** new */


        if (isset($_GET['code'])) {

            $url = 'https://api.betaseries.com/oauth/access_token';

            $fields_string = '';

            $fields = array(

                'code' => urlencode($_GET['code']),

                'client_id' => urlencode("8587f0d7ca5d"),

                'client_secret' => urlencode("705d2a09c446fe226754cccd12d8d747"),

                'redirect_uri' => urlencode('http://localhost/betaseries/'),

                'v' => urlencode($version),

            );

            //url-ify the data for the POST

            foreach ($fields as $key => $value) {

                $fields_string .= $key . '=' . $value . '&';

            }

            rtrim($fields_string, '&');

            //open connection

            $ch = curl_init();

            //set the url, number of POST vars, POST data

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HEADER, false);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            //execute post

            $result = curl_exec($ch);

            $result = json_decode($result, true);

            //if error echo log

            if ($result === false) {

                trigger_error('Erreur curl : ' . curl_error($ch), E_USER_WARNING);

            } else {

                var_dump($result);

            }

            //close connection

            curl_close($ch);

            vardump($result);

        }


        //$api2="8587f0d7ca5d";

//
//        $api3="8587f0d7ca5d";
//
//        $json3=file_get_contents("https://api.betaseries.com/news/last?v=3.0?key=.$api3");
//
//        $result3=json_decode($json3, true);
//
//        $tblArray3=array();
//
//        $tblArray3[]=array(
//            "id"=>$result3[0]["id"],
//            "title"=>$result3[0]["title"],
//            "lien"=>$result3[0]["url"],
//            "picture-url"=>$result3[0]['picture_url'],
//            "date"=>$result3[0]["date"]);
//
//
//        return $this->render('user/dashboard/index.html.twig', array(
//            'array' => $tplArray,
//            'array2' => $tblArray2,
//            'array3'=>$tblArray3
//        ));





    }

//    /**
//     * @Route("/update-user/{id}")
//     * @param Request $request
//     * @param $id
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//
//    public function updateUser(Request $request, $id)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $repository = $em->getRepository(User::class);
//        // objet User dont l'id en bdd est celui reçu dans l'url
//        $user = $repository->find($id);
//
//
//        if ($request->isMethod('POST')) {
//            $user
//                ->setEmail($request->request->get('email'))
//                ->setPseudo($request->request->get('pseudo'))
//                ->setFirstname($request->request->get('firstname'))
//                ->setLastname($request->request->get('lastname'))
//                ->setBirthdate($request->request->get('birthdate'));
//
//            //$emailDuForm = $request->request->get('email');
//            //$user->setEmail($emailDuForm);
//
//            $em->persist($user);
//            $em->flush();
//        }
//
//        return $this->render(
//            'user/dashboard/pages/update-user.html.twig', [
//                'user' => $user
//            ]
//        );
//    }

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

//    public function newSerie()
//    {
//
//        //pour appeler les nouvelles series:
//
//        $api = "f9966f8cc78884142eed6c6d4710717a";
//
//
//        $json = file_get_contents("https://api.themoviedb.org/3/tv/latest?api_key=" . $api . "&language=fr-FR&page=1");
//
//        $result2 = json_decode($json, true);
//
//        $tblArray2 = array();
//
//
//        $tblArray2[] = array(
//            'name' => $result2["original_name"],
//            'datediff' => $result2["first_air_date"],
//            'description' => $result2["next_episode_to_air"]["overview"],
//            'country' => $result2["origin_country"],
//            'episodes' => $result2['number_of_episodes'],
//            'seasons' => $result2['number_of_seasons']
//        );
//
//
//    }

}







