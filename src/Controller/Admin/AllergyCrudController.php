<?php

namespace App\Controller\Admin;

use App\Entity\Allergy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AllergyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Allergy::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Allergies')
        ->setEntityLabelInSingular('Allergie')

        ->setPageTitle('index',  'Administration des utilisateur de quai antique');
    }

    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
    }
    
}
