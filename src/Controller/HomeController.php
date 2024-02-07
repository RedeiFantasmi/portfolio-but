<?php

namespace App\Controller;

use App\Repository\CareerRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        SkillTypeRepository $skillTypeRepository,
        CareerRepository $careerRepository,
        ProjectRepository $projectRepository,
    ): Response       
    {
        $skillTypes = $skillTypeRepository->findAll();

        $careerItems = $careerRepository->findBy(array(), array('startsAt' => 'DESC'));
        $orderedCareers = $this->orderCareersByType($careerItems);

        $lastProjects = $projectRepository->findBy(array(), array('didAt' => 'DESC'), 5);

        return $this->render('home/index.html.twig', [
            'test' => 'test',
            'skillTypes' => $skillTypes,
            'careersByType' => $orderedCareers,
            'projects' => $lastProjects,
        ]);
    }

    public function orderCareersByType($careers)
    {
        $orderedCareers = [];
        foreach ($careers as $career) {
            $orderedCareers[$career->getType()][] = $career;
        }

        return $orderedCareers;
    }
}
