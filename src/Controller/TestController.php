<?php

namespace App\Controller;

//use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestController
 * @package App\Controller
 * @Route("/user")
 */
class TestController extends AbstractController
{


    /**
     * @Route("/test")
     */
    /*public function test(Request $request)
    {
        $tab = [];
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $research = $request->request->get('research');

            $tab['resultat'] = $em->getRepository(Serie::class)->find($research);

            dump($tab);

        } else{

            echo "Pas d'appel AJAX trouvé";

        }

        return  new JsonResponse($tab) .  $this->render('user/test/test.html.twig', [
            'cro' => $tab
        ]);

    }*/


    public function api()
    {
        $api = "f9966f8cc78884142eed6c6d4710717a";

        $baseURI = "http://image.tmdb.org/t/p/";
        $size = "w342";

        $json = file_get_contents("https://api.themoviedb.org/3/tv/popular?api_key=".$api."&language=en-US&page=1");

        $result = json_decode($json, true);

        //$poster_path = $result["poster_path"];
        //$backdrop_path = $result["backdrop_path"];
        //$overview = $result["results"][0]["original_name"];
        $tplArray = array();

        for ($i = 0; $i < count($result['results']); $i++){
            $tplArray[] = array(
                'name' => $result["results"][$i]["original_name"],
                'datediff' => $result["results"][$i]["first_air_date"],
                'description' => $result["results"][$i]["overview"],
                'img' => $baseURI.$size.$result["results"][$i]["poster_path"]
            );
        }

        return $this->render('user/test/test.html.twig', array(
                'array' => $tplArray
            ));
    }

}
