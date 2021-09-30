<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }


    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_EDIT === $pageName || Crud::PAGE_NEW === $pageName) {
            $transactionType = ChoiceField::new('transactionType', 'Type de transaction')
            ->setChoices(fn() => ["A vendre" => true, "A louer" => false]);
            // ->formatValue(function($value) {
            //     return $value === 'A vendre' ? true : false;
            // });
            $slug = SlugField::new('slug')->setTargetFieldName('title');
        } else {
            $transactionType = TextField::new('transactionType');
            $slug = TextField::new('slug');
        }
        // price, floor, rooms, address, zipcode, city, type, transactionType, dateOfConstruction, sell, slug
        return [
            $title =  TextField::new('title'),
            $surface =  IntegerField::new('surface'),
            $content =  TextField::new("content")->hideOnIndex(),
            $price =  MoneyField::new('price')->setCurrency('EUR'),
            $floor =  IntegerField::new('floor'),
            $rooms =  IntegerField::new('rooms'),
            $address =  TextField::new('address')->hideOnIndex(),
            $zipcode =  TextField::new('zipcode')->hideOnIndex(),
            $city =  TextField::new('city'),
            $type =  TextField::new('type'),
            $transactionType,
            $dateOfConstruction =  DateField::new('dateOfConstruction')->hideOnIndex(),
            $sell =  BooleanField::new('sell')->hideOnIndex(),
            $slug
        ];
    }
    
}
