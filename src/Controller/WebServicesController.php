<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Categories;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class WebServicesController extends AbstractController
{
    /**
     * @Route("/web/services", name="web_services")
     */
    public function index(): Response
    {
        return $this->render('web_services/index.html.twig', [
            'controller_name' => 'WebServicesController',
        ]);
    }

    /**
     * @Route("/apiall", name="apiall_produit_show")
     */
    public function webserviceAll(): Response{

        $lesProduits=$this->getDoctrine()->getRepository(Produit::class)->findAll();

        $encoders = [new xmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($lesProduits, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     * @Route("/apiallcategorie", name="apiall_categorie_show")
     */
    public function webserviceAll(): Response{

        $lesCategories=$this->getDoctrine()->getRepository(Categorie::class)->findAll();

        $encoders = [new xmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($lesCategories, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
        /**
     * @Route("/apialluser", name="apiall_user_show")
     */
    public function webserviceAll(): Response{

        $lesUser=$this->getDoctrine()->getRepository(User::class)->findAll();

        $encoders = [new xmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($lesUser, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
}
