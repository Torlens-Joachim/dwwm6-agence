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
                            ["dateOfConstruction" => "DESC"], 
                            5
                        );

        return $this->render('property/index.html.twig', [
            "properties" => $properties
        ]);
    }
}
