<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Entity\Appointment;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AppointmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Appointment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('appointmentDate', "Date de rendez-vous"),
            TextField::new('property.title', "titre")->hideOnForm(),
            ChoiceField::new('property', "propriété")
            ->setChoices(function() {
                $properties = $this->getDoctrine()->getRepository(Property::class)->findAll();

                $data= array();
                foreach ($properties as $value) {
                    $data[] = [$value->getTitle() => $value];
                }
                return $data;
            })
                ->onlyOnForms()
                ,
            TextField::new('email'),
            TextField::new('phone'),
            TextField::new('lastname'),
            TextField::new('firstname'),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $appointment = new Appointment;
        $appointment->setEmployee($this->getUser());
        return $appointment;
    }
}
