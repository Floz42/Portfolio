<?php

namespace App\Controller;

use App\Entity\CVInfos;
use App\Entity\CVSoftSkills;
use App\Repository\CVDiplomesRepository;
use App\Repository\CVExperiencesRepository;
use App\Repository\CVInfosRepository;
use App\Repository\CVSoftSkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class MainController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(CVInfosRepository $repository)
    {
        $infos = $repository->find(2);

        return $this->render('main/cv/infos.html.twig', [
            'infos' => $infos
        ]);
    }

    /**
     * @Route("/cv_infos", name="cv_infos")
     */
    public function cv_infos(CVInfosRepository $repository)
     {
        $infos = $repository->find(2);

        return $this->render('main/cv/infos.html.twig', [
            'infos' => $infos
        ]);
    }

    /**
     * @Route("/cv_diplomes", name="cv_diplomes")
     */
    public function cv_diplomes(CVDiplomesRepository $repository)
    {
        $diplomes = $repository->findAll();

        return $this->render('main/cv/diplomes.html.twig', [
            'diplomes' => $diplomes
        ]);
    }

    /**
     * @Route("/cv_experiences", name="cv_experiences")
     */
    public function cv_experiences(CVExperiencesRepository $repository)
    {
        $xp = $repository->findAll();

        return $this->render('main/cv/experiences.html.twig', [
            'xps' => $xp
        ]);
    }

    /**
     * @Route("/cv_softskills", name="cv_soft_skills")
     */
    public function cv_soft_skills(CVSoftSkillsRepository $repository)
    {

        $softskills = $repository->findAll();

        return $this->render('main/cv/soft_skills.html.twig', [
            "softskills" => $softskills
        ]);
    }

}
