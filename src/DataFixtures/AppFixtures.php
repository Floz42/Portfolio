<?php

namespace App\DataFixtures;

use App\Entity\CVDiplomes;
use App\Entity\CVExperiences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\CVInfos;
use App\Entity\CVSoftSkills;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      /*   $cv_infos = new CVInfos();
        $cv_infos->setName('THIEBAUD')
                 ->setLastname('Florian') 
                 ->setEmail('flo.carreclub@gmail.com')  
                 ->setPicture('profil.jpeg')
                 ->setAge(31)
                 ->setPhone('07.82.87.13.10');
        $manager->persist($cv_infos); 

        $cv_diplomes = new CVDiplomes();
        $cv_diplomes->setLibelle("Baccalauréat série STG Gestion des systèmes d'information")
                    ->setYear("2007");
        $manager->persist($cv_diplomes);

        $cv_diplomes2 = new CVDiplomes();
        $cv_diplomes2->setLibelle("Licence STAPS - Spécialité Entraînement sportif")
                    ->setYear("2011");
        $manager->persist($cv_diplomes2);

        $cv_diplomes3 = new CVDiplomes();
        $cv_diplomes3->setLibelle("Certification Digital Active")
                    ->setYear("2017");
        $manager->persist($cv_diplomes3);

        $cv_diplomes4 = new CVDiplomes();
        $cv_diplomes4->setLibelle("Diplôme Développeur Web Junior - OpenClassrooms (en cours)")
                    ->setYear("2020");
        $manager->persist($cv_diplomes4); */

/*         $cv_experience = new CVExperiences();
        $cv_experience->setName("Éducateur de Tennis")
                      ->setYear("2004-2010");
        $manager->persist($cv_experience);

        $cv_experience2 = new CVExperiences();
        $cv_experience2->setName("Service pass annuel de la STAS")
                      ->setYear("2006");
        $manager->persist($cv_experience2);

        $cv_experience3 = new CVExperiences();
        $cv_experience3->setName("Secrétaire du Tennis Club de La Fouillouse")
                      ->setYear("2006-2007");
        $manager->persist($cv_experience3);

        $cv_experience4 = new CVExperiences();
        $cv_experience4->setName("Animateur en colonies de vacances")
                      ->setYear("2007");
        $manager->persist($cv_experience4);

        $cv_experience5 = new CVExperiences();
        $cv_experience5->setName("Membre du BDE STAPS")
                      ->setYear("2007-2008");
        $manager->persist($cv_experience5);

        $cv_experience6 = new CVExperiences();
        $cv_experience6->setName("Responsable informatique au sein de la FES")
                      ->setYear("2008-2009");
        $manager->persist($cv_experience6);

        $cv_experience7 = new CVExperiences();
        $cv_experience7->setName("Service signalétique de la STAS")
                      ->setYear("2008");
        $manager->persist($cv_experience7);
        
        $cv_experience8 = new CVExperiences();
        $cv_experience8->setName("Animateur en colonies de vacances")
                      ->setYear("2008");
        $manager->persist($cv_experience8);
        
        $cv_experience9 = new CVExperiences();
        $cv_experience9->setName("Président du BDE STAPS")
                      ->setYear("2008-2010");
        $manager->persist($cv_experience9);

        $cv_experience10 = new CVExperiences();
        $cv_experience10->setName("Directeur adjoint en colonies de vacances")
                      ->setYear("2010");
        $manager->persist($cv_experience10);

        $cv_experience11 = new CVExperiences();
        $cv_experience11->setName("Événementiel pour la boîte de nuit \"Le Carré club\"")
                      ->setYear("2009-2011");
        $manager->persist($cv_experience11);

        $cv_experience12 = new CVExperiences();
        $cv_experience12->setName("Événementiel pour le Bar-Pub \"Le Chantier\"")
                      ->setYear("2010-2014");
        $manager->persist($cv_experience12);

        $cv_experience13 = new CVExperiences();
        $cv_experience13->setName("Responsable \"Relationnel étudiant\" pour le \"Carré Club\"")
                      ->setYear("2011-2014");
        $manager->persist($cv_experience13);

        $cv_experience14 = new CVExperiences();
        $cv_experience14->setName("Directeur artistique du \"Carré Club\"")
                      ->setYear("2014-2016");
        $manager->persist($cv_experience14);

        $cv_experience15 = new CVExperiences();
        $cv_experience15->setName("Gérant du Bar-Restaurant \"Le Modern\"")
                      ->setYear("2016-2019");
        $manager->persist($cv_experience15);
 */
        $cv_skills = new CVSoftSkills();
        $cv_skills->setName("Rigoureux");
        $manager->persist($cv_skills);

        $cv_skills2 = new CVSoftSkills();
        $cv_skills2->setName("Atunome");
        $manager->persist($cv_skills2);

        $cv_skills3 = new CVSoftSkills();
        $cv_skills3->setName("Organisé");
        $manager->persist($cv_skills3);

        $cv_skills4 = new CVSoftSkills();
        $cv_skills4->setName("Travail en équipe");
        $manager->persist($cv_skills4);

        $cv_skills5 = new CVSoftSkills();
        $cv_skills5->setName("Créatif");
        $manager->persist($cv_skills5);

        $cv_skills6 = new CVSoftSkills();
        $cv_skills6->setName("Curieux");
        $manager->persist($cv_skills6);

        $cv_skills7 = new CVSoftSkills();
        $cv_skills7->setName("Engagement");
        $manager->persist($cv_skills7);



        $manager->flush();


 

    }
}
