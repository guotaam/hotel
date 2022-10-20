<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('chambre')->renderAsNativeWidget() ,
            TextField::new('prenom'),
            DateTimeField::new('date_arrivee')->setFormat("d/M/Y à H:m:s")->hideOnForm(),
          DateTimeField::new('date_depart')->setFormat("d/M/Y à H:m:s")->hideOnForm(),
            IntegerField::new('prix_total'),
            TextField::new('nom'),
            TextField::new('telephone'),
            EmailField::new('email'),
            DateTimeField::new('createdAt')->setFormat("d/M/Y à H:m:s")->hideOnForm(),

        ];

    
}
}