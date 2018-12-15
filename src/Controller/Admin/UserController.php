<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 06/12/2018
 * Time: 14:59
 */

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 *
 */
class UserController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(User::class);
        $users = $repository->findAll();


        return $this->render(
            'admin/gestion-user/index.html.twig',
            [
                'users' => $users,
            ]
        );
    }

    /**
     * @Route("/upgrade-status/{id}")
     */
    public function upgradeStatus(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $user->setStatus('ROLE_ADMIN');

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('app_admin_user_index');
    }

    /**
     * @Route("/downgrade-status/{id}")
     */
    public function downgradeStatus(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $user->setStatus('ROLE_USER');

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('app_admin_user_index');
    }

    /**
     * @Route("/delete-user/{id}")
     */
    public function deleteUser(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        $this->addFlash(
            'success',
            'L\'utilisateur a été supprimé de la bdd'
        );

        return $this->redirectToRoute('app_admin_user_index');
    }

}