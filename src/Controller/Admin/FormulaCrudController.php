<?php

namespace App\Controller\Admin;

use App\Entity\Formula;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormulaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formula::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Formules')
        ->setEntityLabelInSingular('Formule')

        ->setPageTitle('index',  'Administration des utilisateur de quai antique');
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
        yield AssociationField::new('menu');
    }
    
}
