<?php

namespace App\Controller;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Projet')
            ->setEntityLabelInPlural('Projets')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')
                ->hideOnForm()
            ;
            yield TextField::new('name', 'Nom');
            yield TextField::new('context', 'Contexte')
                ->hideOnIndex()
            ;
            yield NumberField::new('timePassed', 'Temps passé (en h)');
            yield TextField::new('location', 'Lieu de réalisation');
            yield DateField::new('didAt', 'date de réalisation');
            yield ImageField::new('cover', 'Image de couverture')
                ->setBasePath('/assets/img/projects')
                ->setUploadDir('public/assets/img/projects')
            ;
            yield TextareaField::new('summary', 'Résumé')
                ->hideOnIndex()
            ;
            yield TextEditorField::new('description');
            yield AssociationField::new('tags', 'Libellés');
            yield AssociationField::new('technologies', 'Techno utilisées');
            yield TextField::new('github', 'Lien GitHub')
                ->onlyOnForms()
            ;
            yield ChoiceField::new('type')
                ->setChoices([
                    'Scolaire' => 'sco',
                    'Professionnel' => 'pro',
                ])
            ;
            yield AssociationField::new('butSkills', 'Compétences');
    }
}
