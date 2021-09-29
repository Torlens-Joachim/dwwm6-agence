<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Property;
use App\Form\AppointmentType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swift_Mailer;
use Swift_Message;

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

    #[Route('/biens', name: "properties")]
    public function properties(PaginatorInterface $paginator, Request $request): Response
    {
        $properties = $this->getDoctrine()->getRepository(Property::class)->findFilterProperties($request->query->all());

        $pagination = $paginator->paginate(
            $properties,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render("property/properties.html.twig", [
            "pagination" => $pagination,
            "filters" => $request->query->all()
        ]);
    }

    #[Route('/bien/{slug}', name: "property_show")]
    public function show(Property $property, Request $request, Swift_Mailer $mailer): Response
    {
        $appointment = new Appointment;
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $appointment->setProperty($property)
                    ->setEmployee($property->getEmployee());

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($appointment);
                $manager->flush();

                try {
                    $email = (new Swift_Message("Confirmation de rendez-vous pour la visite du bien " . $property->getTitle()))
                        ->setFrom("no-reply@agency.fr")
                        ->setTo($appointment->getEmail())
                        ->setCc($property->getEmployee()->getEmail())
                        ->setBody(
                            $this->renderView(
                                "email/appointment/confirmation.html.twig",
                                [
                                    "appointment" => $appointment
                                ]
                            )
                        );
                    $mailer->send($email);
                    $this->addFlash(
                        "success",
                        "Le rendez-vous est enregistré, vous allez recevoir un mail de confirmation sur l'adresse mail: " . $appointment->getEmail()
                    );
                } catch (\Exception $e) {
                    $this->addFlash(
                        "warning",
                        "Le rendez-vous est enregistré mais nous avons eu un problème lors de l'envoie du mail de confirmation, notre agent va vous rappeler."
                    );
                }
            } catch (\Throwable $th) {
                $this->addFlash(
                    "danger",
                    "Une erreur s'est produite, merci de réessayer."
                );
            }

            return $this->redirectToRoute("property_show", [
                "slug" => $property->getSlug()
            ]);
        }

        return $this->render("property/show.html.twig", [
            "property" => $property,
            "form" => $form->createView()
        ]);
    }
}
