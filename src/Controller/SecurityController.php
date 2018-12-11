<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                // encode le mot de passe, à partir de la config "encoders" de security.yaml
                $password = $passwordEncoder->encodePassword(
                    $user,
                    $user->getPlainpassword()
                );

                $user->setPassword($password);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre compté est créé');

                return $this->redirectToRoute('app_index_index');

            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }



        return $this->render('security/register.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        //traite le formulaire par security
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        if(!empty($errors)){
            $this->addFlash('error', 'Les identifiants sont incorrects');
        } else {
            $this->redirectToRoute('app_index_index');
        }



        return $this->render('security/login.html.twig',
            [
                'last_username' => $lastUsername
            ]);
    }


    /**
     * @Route("/api")
     */
    public function api()
    {
        $string = [file_get_contents('https://api.themoviedb.org/3/tv/60?api_key=f9966f8cc78884142eed6c6d4710717a&language=en-US'), file_get_contents('https://api.themoviedb.org/3/tv/71663?api_key=f9966f8cc78884142eed6c6d4710717a&language=en-US')];

        $img = ['https://image.tmdb.org/t/p/w185/ousZgyHc994KRdaKE2UjySAdn4O.jpg','https://image.tmdb.org/t/p/w185/tM3i08Xs5I1bg5DB6sa9H0Zpt9e.jpg'];



        /*
        $json_data = [];
        $i = 0;

        foreach($string as $info) {

            $json_table = json_decode($info, true);

            $json_data[$i]["poster_path"] = "https://image.tmdb.org/t/p/w185".$json_table['poster_path'];

            $json_data[$i]["name"] = $json_table['name'];
            $i++;
        }*/




        // print_r($json_data);


        return $this->render('security/api.html.twig',
            [
                'json_data' => $json_data
            ]);
    }
}
