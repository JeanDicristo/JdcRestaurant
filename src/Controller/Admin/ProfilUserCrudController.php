<?php

namespace App\Controller\Admin;

use App\Entity\ProfilUser;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ProfilUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfilUser::class;
    }


    public function configureFields(string $pageName): iterable
    {

        $fields = [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            IntegerField::new('guest'),
        ];

        $password = TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => '(Repeat)'],
                'mapped' => false,
            ])
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms()
            ;
        $fields[] = $password;

        $roles = ['ROLE_ADMIN', 'ROLE_USER'];

        $fields[] = ChoiceField::new('roles')
                                    ->setChoices(array_combine($roles, $roles))
                                    ->allowMultipleChoices();

        return $fields;

    }
}
