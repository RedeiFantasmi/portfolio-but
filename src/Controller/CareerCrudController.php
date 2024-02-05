<?php

namespace App\Controller;

use App\Entity\Career;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CareerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Career::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Etape')
            ->setEntityLabelInPlural('Parcours')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm()
        ;
        yield ChoiceField::new('type')
            ->setChoices([
                'Scolaire' => 'sco',
                'Professionnel' => 'pro',
            ])
        ;
        yield TextField::new('title', 'Titre');
        yield DateField::new('startsAt', 'Début');
        yield DateField::new('endsAt', 'Fin');
        yield TextEditorField::new('description');
    }
}
