<?php
namespace App\Controller\Admin;

use App\Entity\CVDiplomes;
use App\Entity\CVExperiences;
use App\Entity\CVInfos;
use App\Entity\CVSoftSkills;
use App\Form\CvDiplomesType;
use App\Form\CvExperiencesType;
use App\Form\CvInfosType;
use App\Form\CvSskillsType;
use App\Repository\CVDiplomesRepository;
use App\Repository\CVInfosRepository;
use App\Repository\CVSoftSkillsRepository;
use App\Repository\CVExperiencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class CVController extends AbstractController
{

    /**
     * Index of cv administration
     * 
     * @Route("/admin/admin_cv", name="admin_cv")
     */
    public function admin_cv_index()
    {
        return $this->render('admin/cv/admin_cv.html.twig');
    }

    /**
     * Show diplomes in ajax
     * 
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
     * Show xp in ajax
     * 
     * @Route("/admin/admin_experiences_ajax", name="admin_experiences_ajax")
     */
    public function experiences_ajax(CVExperiencesRepository $repository)
    {
   
        $xp = $repository->findAll();

        return $this->render('admin/cv/admin_cv_xp.html.twig', [
            'xps' => $xp,
        ]);
    }

    /**
     * Show infos in ajax
     * 
     * @Route("/admin/admin_infos_ajax", name="admin_infos_ajax")
     */
    public function infos_ajax(CVInfosRepository $repository) 
    {
       $infos = $repository->find(4);

       return $this->render('admin/cv/admin_cv_infos.html.twig', [
           'infos' => $infos
       ]);
    }


    /**
     * show soft skills in ajax
     * 
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
     * The same method to add or edit a xp
     *  
     * @Route("/admin/add_xp", name="add_xp", methods="GET|POST")
     * @Route("/admin/xp/{id}", name="update_xp", methods="POST|GET")
     */
    public function add_xp(CVExperiences $experience = null, Request $request, ObjectManager $manager)
    {
        $exist = true;
        $message = "Votre expérience a bien été modifiée.";
        if (!$experience) {
            $exist = false;
            $experience = new CVExperiences();
            $message = "Votre expérience a bien été ajoutée.";
        }

        $form = $this->createForm(CvExperiencesType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($experience);
            $manager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('admin_cv');
        } 
        
        return $this->render('admin/cv/add_xp.html.twig', [
            'form' => $form->createView(),
            'exist' => $exist
        ]);
    }

    /**
     * Delete a xp 
     * 
     * @Route("/admin/delete_xp/{id}", name="delete_xp", methods="POST|GET")
     */
    public function delete_xp(CVExperiences $xp, ObjectManager $manager): Response
    {
        $manager->remove($xp);
        $manager->flush();
        $this->addFlash('success', "L'expérience a bien été supprimée.");
        return $this->redirectToRoute('admin_cv');
    }

     /**
     * The same method to add or edit a diplome 
     * 
     * @Route("/admin/add_diplome", name="add_diplome", methods="GET|POST")
     * @Route("/admin/diplome/{id}", name="update_diplome", methods="POST|GET")
     */
    public function add_diplome(CVDiplomes $diplome = null, Request $request, ObjectManager $manager)
    {
        $exist = true;
        $message = "Votre diplôme a bien été modifiée.";
        if (!$diplome) {
            $exist = false;
            $diplome = new CVDiplomes();
            $message = "Votre diplôme a bien été ajoutée.";
        }

        $form = $this->createForm(CvDiplomesType::class, $diplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($diplome);
            $manager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('admin_cv');
        } 
        
        return $this->render('admin/cv/add_diplome.html.twig', [
            'form' => $form->createView(),
            'exist' => $exist
        ]);
    }

    /**
     * @Route("/admin/delete_diplome/{id}", name="delete_diplome", methods="POST|GET")
     */
    public function delete_diplome(CVDiplomes $diplome, ObjectManager $manager): Response
    {
        $manager->remove($diplome);
        $manager->flush();
        $this->addFlash('success', "Le diplôme a bien été supprimé.");
        return $this->redirectToRoute('admin_cv');
    }

    /**
     * The same method to add or edit a soft skill
     * 
     * @Route("/admin/add_sskill", name="add_sskill", methods="GET|POST")
     * @Route("/admin/sskill/{id}", name="update_sskill", methods="POST|GET")
     */
    public function add_sskill(CVSoftSkills $sskill = null, Request $request, ObjectManager $manager)
    {
        $exist = true;
        $message = "Votre Softskill a bien été modifiée.";
        if (!$sskill) {
            $exist = false;
            $sskill = new CVSoftSkills();
            $message = "Votre Softskill a bien été ajoutée.";
        }

        $form = $this->createForm(CvSskillsType::class, $sskill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($sskill);
            $manager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('admin_cv');
        } 
        
        return $this->render('admin/cv/add_sskill.html.twig', [
            'form' => $form->createView(),
            'exist' => $exist
        ]);
    }

    /**
     * @Route("/admin/delete_sskill/{id}", name="delete_sskill", methods="POST|GET")
     */
    public function delete_sskill(CVSoftSkills $skill, ObjectManager $manager): Response
    {
        $manager->remove($skill);
        $manager->flush();
        $this->addFlash('success', "Le soft skill a bien été supprimé.");
        return $this->redirectToRoute('admin_cv');
    }

    /**
     * Edit informations (avatar and other)
     * 
     * @Route("/admin/infos/{id}", name="update_infos", methods="POST|GET")
     */
    public function update_infos(CVInfos $infos , Request $request, ObjectManager $manager)
    {
        $message = "Vos informations ont bien été modifiées.";

        $form = $this->createForm(CvInfosType::class, $infos);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($infos);
            $manager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('admin_cv');
        } 
        
        return $this->render('admin/cv/update_infos.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}