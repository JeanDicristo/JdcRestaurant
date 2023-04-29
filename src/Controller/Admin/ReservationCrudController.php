<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Menus')
        ->setEntityLabelInSingular('Menu')

        ->setPageTitle('index',  'Administration des utilisateur de quai antique');
    }

    public function configureFields(string $pageName): iterable
    {
                yield from parent::configureFields($pageName);
    }
    
}
