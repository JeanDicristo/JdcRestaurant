<?php

namespace App\Controller\Admin;

use App\Entity\Hourly;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HourlyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hourly::class;
    }
   
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Horaires')
        ->setEntityLabelInSingular('Horaire')

        ->setPageTitle('index',  'Administration des utilisateur de quai antique');
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
        
    }
    
}
