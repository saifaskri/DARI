<?php

namespace App\Controller\Admin;

use App\Entity\AccomodationType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AccomodationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AccomodationType::class;
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
