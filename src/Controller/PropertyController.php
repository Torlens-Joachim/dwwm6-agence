<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $properties = $this->getDoctrine()->getRepository(Property::class)->findBy(
                            [], 
                            ["id" => "DESC"], 
                            5
                        );

        return $this->render('property/index.html.twig', [
            "properties" => $properties
        ]);
    }

    #[Route('/biens', name:"properties")]
    public function properties (): Response
    {
        $properties = $this->getDoctrine()->getRepository(Property::class)->findAll();

        return $this->render("property/properties.html.twig", [
            "properties" => $properties
        ]);
    }

    #[Route('/bien/{slug}', name:"property_show")]
    public function show (Property $property): Response
    {
        return $this->render("property/show.html.twig", [
            "property" => $property
        ]);
    }
}
