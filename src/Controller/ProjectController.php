<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectTag;
use App\Repository\ButSkillRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectTagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function index(
        ProjectRepository $projectRepository,
        ProjectTagRepository $projectTagRepository,
        ButSkillRepository $butSkillRepository,
    ): Response
    {
        $projects = $projectRepository->findBy(array(), array('didAt' => 'DESC'));
        $tags = $projectTagRepository->findAll();
        $butSkills = $butSkillRepository->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
            'tags' => $tags,
            'butSkills' => $butSkills,
        ]);
    }

    #[Route('/project/{id}', name: 'app_project_detail')]
    public function detail(Project $project): Response
    {
        return $this->render('project/detail.html.twig', [
            'project' => $project
        ]);
    }
}
