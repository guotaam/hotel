<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }

    
   public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('description'),
            TextareaField::new('description_longue'),
            TextField::new('photo'),
            IntegerField::new('prix_journalier'),
            DateTimeField::new('createdAt')->setFormat("d/M/Y à H:m:s")->hideOnForm(),
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $produit =new $entityFqcn;
        $produit->setCreatedAt(new \DateTime);
        return $produit;
    }

}
