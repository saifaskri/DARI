<?php

namespace App\Controller\Admin;

use App\Entity\RentPeriodation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RentPeriodationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RentPeriodation::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
