<?php

namespace App\Controller\Admin;

use App\Entity\Advertisment;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class 
AdvertismentCrudController extends AbstractCrudController
{
    public const ADVERTISMENT_BASE_PATH='Uploads/imgs';
    public const ADVERTISMENT_UPLOAD_FOTOS='public/Uploads/imgs';



    public static function getEntityFqcn(): string
    {
        return Advertisment::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id','Ads_Id')->hideOnForm(),
            AssociationField::new('OwnedBy','Posted By')
                ->hideOnForm()
                ->setQueryBuilder(function(ORMQueryBuilder $queryBuilder){
                    $queryBuilder->where('entity.Owned_By = 7');
                }),
            TextField::new('advertismentName')->setRequired(true),
            SlugField::new('slug')->setTargetFieldName('advertismentName')
                ->setRequired(true),
            AssociationField::new('accommodationType','Accommodation Type')
                ->setRequired(true)
                ->setQueryBuilder(function(ORMQueryBuilder $queryBuilder){
                    $queryBuilder->where('entity.status = true');
                }),
            AssociationField::new('RentsPeriodation','Type Of Rent')
                ->setRequired(true)
                ->setQueryBuilder(function(ORMQueryBuilder $queryBuilder){
                $queryBuilder->where('entity.status = true');
            }),
            AssociationField::new('state')
                ->setRequired(true)
                ->setQueryBuilder(function(ORMQueryBuilder $queryBuilder){
                $queryBuilder->where('entity.status = true');
            }),
            DateTimeField::new('createdat')
                ->hideOnForm(),
            DateTimeField::new('updatedat')
                ->hideOnForm(),
            DateField::new('AvailibilityDate','Availiable From')
                ->setRequired(true),
            DateField::new('ValidityDate','Availiable Until')
                ->setRequired(false),
            MoneyField::new('price')->setCurrency('TND')
                ->setRequired(true),
            ImageField::new('illusttration')
                ->setRequired(false)
                ->setBasePath(self::ADVERTISMENT_BASE_PATH)
                ->setUploadDir(self::ADVERTISMENT_UPLOAD_FOTOS)
                ->setUploadedFileNamePattern(md5(uniqid()).'[randomhash][name].[extension]'),
            BooleanField::new('status','Visibility'),
            TextEditorField::new('description')
                ->setRequired(true),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (($entityInstance instanceof Advertisment )){
            $entityInstance->setOwnedBy($this->getUser());
        };
        parent::persistEntity($em, $entityInstance);
    }
}
