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
    public function index()
    {
        return $this->render('main/cv/accueil.html.twig');
    }

    /**
     * @Route("/diplomes_ajax", name="diplomes_ajax")
     */
    public function cv_diplomes(CVDiplomesRepository $repository)
    {
        $diplomes = $repository->findAll();

        return $this->render('main/cv/diplomes_ajax.html.twig', [
            'diplomes' => $diplomes
        ]);
    }

    /**
     * @Route("/experiences_ajax", name="experiences_ajax")
     */
    public function experiences_ajax(CVExperiencesRepository $repository)
    {
        $xp = $repository->findAll();

        return $this->render('main/cv/experiences_ajax.html.twig', [
            'xps' => $xp
        ]);
    }

    /**
     * @Route("/softskills_ajax", name="softskills_ajax")
     */
    public function softskills_ajax(CVSoftSkillsRepository $repository)
    {

        $softskills = $repository->findAll();

        return $this->render('main/cv/softskills_ajax.html.twig', [
            "softskills" => $softskills
        ]);
    }

    /**
     * @Route("/infos_ajax", name="infos_ajax")
     */
     public function infos_ajax(CVInfosRepository $repository) 
     {
        $infos = $repository->find(2);

        return $this->render('main/cv/infos_ajax.html.twig', [
            'infos' => $infos
        ]);
     }


}
