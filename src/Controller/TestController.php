<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestController
 * @package App\Controller
 * @Route("/user")
 */
class TestController extends AbstractController
{

    /*
    public function test(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Serie::class);
        $research = $repository->find($request->request->get('research'));
        $tab=[];
        //check si j'ai reçu un appel ajax
        if($request->isXmlHttpRequest()) {

            // on récupère la recherche de l'utilisateur

            // on stocke notre résultat de la recherche dans une entréé d'un tableau
            $tab['resultat'] = $research->setName($research['name']);
            return new JsonResponse($tab);
        } else {

            echo "Je ne pas reçu d'appel AJAX";

        }

        return $this->render('user/test/test.html.twig');

    }*/

    /**
     * @Route("/test")
     */
    public function api(Request $request)
    {
        $api = "f9966f8cc78884142eed6c6d4710717a";

        $keywords = '';

        $string = file_get_contents("https://api.themoviedb.org/3/search/tv?page=1&query=".$keywords."&language=en-US&api_key=".$api);

        if (is_null($keywords)){
            $keywords = $request->request->get('research');
        }

        $json_data = json_decode($string);
        dump($json_data);


        return $this->render('user/test/test.html.twig',
            [
                'json_data' => $json_data['name'],
                'keyword' => $keywords
            ]);
    }

}
