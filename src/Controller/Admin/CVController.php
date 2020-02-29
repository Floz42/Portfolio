<?php
namespace App\Controller\Admin;

use App\Entity\CVDiplomes;
use App\Entity\CVExperiences;
use App\Entity\CVInfos;
use App\Entity\CVSoftSkills;
use App\Repository\CVDiplomesRepository;
use App\Repository\CVInfosRepository;
use App\Repository\CVSoftSkillsRepository;
use App\Repository\CVExperiencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Component\HttpFoundation\Response;

class CVController extends AbstractController
{

    /**
     * @Route("/admin/admin_cv", name="admin_cv")
     */
    public function admin_cv_index()
    {
        return $this->render('admin/cv/admin_cv.html.twig');
    }

        /**
     * @Route("/admin/admin_diplomes_ajax", name="admin_diplomes_ajax")
     */
    public function cv_diplomes(CVDiplomesRepository $repository)
    {
        $diplomes = $repository->findAll();

        return $this->render('admin/cv/admin_cv_diplomes.html.twig', [
            'diplomes' => $diplomes
        ]);
    }

    /**
     * @Route("/admin/admin_experiences_ajax", name="admin_experiences_ajax")
     */
    public function experiences_ajax(CVExperiencesRepository $repository)
    {
        $xp = $repository->findAll();

        return $this->render('admin/cv/admin_cv_xp.html.twig', [
            'xps' => $xp
        ]);
    }

    /**
     * @Route("/admin/admin_infos_ajax", name="admin_infos_ajax")
     */
    public function infos_ajax(CVInfosRepository $repository) 
    {
       $infos = $repository->find(2);

       return $this->render('admin/cv/admin_cv_infos.html.twig', [
           'infos' => $infos
       ]);
    }


    /**
     * @Route("/admin/admin_softskills_ajax", name="admin_softskills_ajax")
     */
    public function softskills_ajax(CVSoftSkillsRepository $repository)
    {
        $softskills = $repository->findAll();

        return $this->render('admin/cv/admin_cv_sskills.html.twig', [
            "softskills" => $softskills
        ]);

        return $this->render('admin/cv/admin_cv.html.twig');

    }
    
    /**
     * @Route("/admin/delete_xp/{id}", name="delete_xp", methods="POST|GET")
     */
    public function delete_xp(CVExperiencesRepository $repository, CVExperiences $xp, ObjectManager $manager): Response
    {
        $xps = $repository->findAll();
        $manager->remove($xp);
        $manager->flush();
        return $this->redirectToRoute('admin_cv');
    }

    /**
     * @Route("/admin/update_xp/{id}", name="update_xp", methods="POST|GET")
     */
    public function update_xp(CVExperiences $xp)
    {

    }

}