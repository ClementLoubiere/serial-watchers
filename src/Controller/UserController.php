<?php
/**
 * Created by PhpStorm.
 * User: julialuquot
 * Date: 2018-12-07
 * Time: 10:11
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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



        return $this->render('user/index.html.twig');

    }

    /**
     *
     * @param Request $
     * @param $request
     */
    public function apiSearch(Request, $request){

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('{}');

        $request->setRequestUrl('https://api.themoviedb.org/3/search/tv');
        $request->setRequestMethod('GET');
        $request->setBody($body);

        $request->setQuery(new http\QueryString(array(
            'page' => '1',
            'language' => 'en-US',
            'api_key' => 'f9966f8cc78884142eed6c6d4710717a'
        )));

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();


    }




    public function calendarApi(Request $request){

        if(isset($_GET['calendar'])){
            $url = "GET https://api.betaseries.com/planning/general";
            $parameters = array(
                'date' => date_time_set(),
                'before' =>'8',
                'after' => '8',

                'type' => http_build_query(
                    array("outboundSMSMessageRequest" => array(
                        "address" => "tel:+99900000xxxxxx",
                        "senderAddress" => "tel%3A%2B99900000xxxxxx",
                        "outboundSMSTextMessage" => array("message" => "RapidSMS Test SMS !")
                    )
                    )
                ),
            );



        }


}


