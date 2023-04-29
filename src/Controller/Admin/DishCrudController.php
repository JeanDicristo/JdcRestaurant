<?php

namespace App\Controller\Admin;

use App\Entity\Dish;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DishCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dish::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Plats')
        ->setEntityLabelInSingular('Plat')

        ->setPageTitle('index',  'Administration des utilisateur de quai antique');
    }
    
    public function configureFields(string $pageName): iterable
    {
        //yield from parent::configureFields($pageName);
        yield TextField::new('title');
        yield TextareaField::new('description');
        yield NumberField::new('price');

        yield TextareaField::new('imageFile')->setFormType(VichImageType::class);
        yield AssociationField::new('category');
    }
    
}
