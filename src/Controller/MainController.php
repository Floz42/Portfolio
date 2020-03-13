<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Contact;
use App\Entity\Comments;
use App\Form\ContactType;
use App\Form\InscriptionType;
use App\Repository\CVInfosRepository;
use App\Repository\CommentsRepository;
use App\Repository\CVDiplomesRepository;
use App\Repository\CVSoftSkillsRepository;
use App\Repository\CVExperiencesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MainController extends AbstractController
{

    /**
     * Index of portfolio, instanciation of form contact
     * 
     * @Route("/", name="accueil", methods="POST|GET")
     */
    public function index(Request $request, \Swift_Mailer $mailer, CommentsRepository $repository, PaginatorInterface $paginator)
    {
        $contact = new Contact();
        $form_contact = $this->createForm(ContactType::class, $contact);

        $form_contact->handleRequest($request);
        if ($form_contact->isSubmitted() && $form_contact->isValid()) {
            $data = $form_contact->getData();
            $message = (new \Swift_Message())
                ->setSubject('Nouveau message de ton Portfolio !!')
                ->setFrom($data->getEmail())
                ->setTo('flo.carreclub@gmail.com')
                ->setContentType("text/html")
                ->setBody(
                    '<html>' . 
                        '<body>' . 
                            'Nouveau message de : '. $data->getFirstname() . ' ' . $data->getLastname() . '<br>' .
                            'Son e-mail : '. $data->getEmail() . '<br>' .
                            'Titre du message : ' . $data->getTitle() . '<br>' .
                            'Contenu du message : ' . $data->getContent() . '<br>' .
                        '</body>' . 
                    '</html>' 
                );
            $mailer->send($message);
        }
        
        $comments = $paginator->paginate(
            $repository->paginationComments(),
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('main/cv/accueil.html.twig', [
            'form_contact' => $form_contact->createView(),
            'comments' => $comments
        ]);
    }

    /**
     * Post comment in ajax and php et show it directely
     * 
     * @Route("/post_comment", name="post_comment", methods="POST|GET")
     */
    public function post_comment(Request $request, ObjectManager $manager, CommentsRepository $repository, PaginatorInterface $paginator)
    {
        $user = $this->getUser();
        $comment = new Comments();
            $comment->setComment($_POST['message']);
            $comment->setDate_comment(new \DateTime());
            $comment->setUsers($user);
            $manager->persist($comment);
            $manager->flush();

            $comments = $paginator->paginate(
                $repository->paginationComments(),
                $request->query->getInt('page', 1),
                3
            );
            return $this->render('main/comments.html.twig', [
                'comments' => $comments 
            ]);
    }

    /**
     * Resfresh comments zone after post one in ajax
     * 
     * @Route("/show_comments", name="show_comments")
     */
    public function show_comments(PaginatorInterface $paginator, Request $request, CommentsRepository $repository)
    {
        $comments = $paginator->paginate(
            $repository->paginationComments(),
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('main/post_comments.html.twig', [
            'comments' => $comments 
        ]);   
    }

    /**
     * Show cv diplomes in ajax
     * 
     * @Route("/diplomes_ajax", name="diplomes_ajax")
     */
    public function diplomes_ajax(CVDiplomesRepository $repository)
    {
        $diplomes = $repository->findAll();

        return $this->render('main/cv/diplomes_ajax.html.twig', [
            'diplomes' => $diplomes
        ]);
    }

    /**
     * Show cv experiences in ajax
     * 
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
     * Show sc soft skills in ajax
     * 
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
     * Show cv infos in ajax
     * 
     * @Route("/infos_ajax", name="infos_ajax")
     */
     public function infos_ajax(CVInfosRepository $repository) 
     {
        $infos = $repository->find(4);

        return $this->render('main/cv/infos_ajax.html.twig', [
            'infos' => $infos
        ]);
     }

    /**
     * Form subscribe 
     * 
     * @Route("/subscribe_ajax", name="subscribe_ajax", methods="POST|GET")
     */
    public function show_subscribe_ajax(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) 
    {
        $subscribe = new Users();
        $form_subscribe = $this->createForm(InscriptionType::class, $subscribe);
        $form_subscribe->handleRequest($request); 
        if ($form_subscribe->isSubmitted() && $form_subscribe->isValid()) {
            $passwordCrypt = $encoder->encodePassword($subscribe, $subscribe->getPassword());
            $subscribe->setPassword($passwordCrypt);
            $subscribe->setRoles('ROLE_USER');
            $manager->persist($subscribe);
            $manager->flush();
            $this->addFlash('success_confirm', 'Votre inscription est bien prise en compte, vous pouvez maintenant vous connecter.');
            return $this->redirectToRoute('accueil');
        } elseif ($form_subscribe->isSubmitted() && !$form_subscribe->isValid()) {
            $this->addFlash('error_confirm', 'Votre pseudo est déjà pris, merci d\'en choisir un autre.');
            return $this->redirectToRoute('accueil');
        }

        return $this->render('main/subscribe.html.twig', [
            'form_subscribe' => $form_subscribe->createView()
        ]);
    }

    /**
     * RGPD page 
     * 
     * @Route("/rgpd", name="rgpd")
     */
    public function rgpd() 
    {
        return $this->render('main/RGPD.html.twig');
    }

    /**
     * Form login
     * 
     * @Route("/login", name="login", methods="POST|GET")
     */
    public function login(AuthenticationUtils $util)
    {
        if ($util->getLastAuthenticationError()) {
            $this->addFlash('error_confirm', 'Erreur : mauvais pseudo et/ou mot de passe');
            return $this->redirectToRoute('accueil');
        } else {
            $this->addFlash('success_confirm', "Vous êtes bien connecté et pouvez laisser un commentaire.");
        }
        return $this->render('main/submit.html.twig', [
            "lastUsername" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }

    /**
    * @Route("/logout", name="logout")
    */
    public function logout() 
    {
        return $this->redirectToRoute('accueil',[
            "deconnexion" => true
        ]);
    }

}
