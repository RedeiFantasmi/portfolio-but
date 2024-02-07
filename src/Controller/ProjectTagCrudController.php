<?php

namespace App\Controller;

use App\Entity\ProjectTag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectTagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectTag::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Libellé')
            ->setEntityLabelInPlural('Libellés (projet)')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')
                ->hideOnForm()
            ;
            yield TextField::new('label', 'Titre');
            yield ColorField::new('color', 'Couleur');
    }
}
