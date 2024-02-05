<?php

namespace App\Controller;

use App\Repository\CareerRepository;
use App\Repository\SkillRepository;
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
    ): Response       
    {
        $skillTypes = $skillTypeRepository->findAll();

        $careerItems = $careerRepository->findAll();
        $orderedCareers = $this->orderCareersByType($careerItems);

        return $this->render('home/index.html.twig', [
            'test' => 'test',
            'skillTypes' => $skillTypes,
            'careersByType' => $orderedCareers,
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
