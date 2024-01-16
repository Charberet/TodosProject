<?php

namespace App\Controller\Admin;

use App\Entity\Tasks;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TasksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tasks::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('name'),
            DateField::new('date'),
            TextEditorField::new('priority'),
            AssociationField::new('TypeCategory')
            
        ];
    }

    
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Tasks) return;

        $entityInstance->setIdUser($this->getUser());

        parent::persistEntity($entityManager, $entityInstance);
       
        
    }
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance):void
    {
        if (!$entityInstance instanceof Tasks) return;

        parent::persistEntity($entityManager, $entityInstance);
    }
    
}
