<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 11/12/2018
 * Time: 10:42
 */

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller\Admin
 * @Route("/product")
 */
class ProductController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Product::class);
        $products = $repository->findAll();

        return $this->render(
            'admin/product/index.html.twig',
            [
                'products' => $products
            ]
        );
    }



    /**
     * @Route("/edition/{id}", defaults={"id": null}, requirements={"id":"\d+"})
     */
    public function edit(Request $request, $id)
    {

        /* Lien avec la bdd */
        $em = $this->getDoctrine()->getManager();

        /* initialisation d'une variable pour la gestion de la photo en création/édit*/
        $originalImage = null;

        /* création d'une catégorie */
        if(is_null($id)){
            /* Création d'un objet de la class Product*/
            $product = new Product();
        }else{ // modification d'une catégorie
            $product = $em->find(Product::class, $id);

            if(!is_null($product->getImage())){
                // nom du fichier venant de la bdd
                $originalImage = $product->getImage();
                //on set l'image avec un objet File pour le traitement par le formulaire
                $product->setImage(
                    new File($this->getParameter('upload_dir') . $originalImage)
                );
            }

            // 404 si l'id recu dans l'url n'est pas en bdd
            if(is_null($product)){
                throw new NotFoundHttpException();
            }
        }

        /* Création du formulaire */
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        /* Vérification si le form est soumis */
        if($form->isSubmitted()){
            /* Vérification de la validité des champs*/
            if($form->isValid()){

                /* Gestion de l'image */
                /**@var UploadedFile $image*/
                $image = $product->getImage();
                if(!is_null($image)){
                    $filename = uniqid(). '.' . $image->guessExtension();
                    $image->move(
                        $this->getParameter('upload_dir'),
                        $filename
                    );
                    $product->setImage($filename);

                    // ici prévoir la gestion de l'image en cas de modification d'un produit


                } else {
                    $product->setImage($originalImage);
                }


                /* Ajout du produit en bdd */
                $em->persist($product);
                $em->flush();

                /* Message de success si ajout effectué en bdd */
                $this->addFlash('success', 'Le produit est bien enregistré dans la base de donnée');

                /* Redirection sur la liste des produits */
                return $this->redirectToRoute('app_admin_product_index');


            } else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }

        }

        return $this->render(
            'admin/product/edit.html.twig',
            [
                'form' => $form->createView(),
                'original_image' => $originalImage
            ]
        );
    }

    /**
     * @Route("/suppression/{id}")
     */
    public function delete(Product $product) // param converter
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($product);
        $em->flush();

        $this->addFlash(
            'success',
            'Le produit est supprimé'
        );

        return $this->redirectToRoute('app_admin_product_index');
    }
}