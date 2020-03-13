<?php
namespace App\Controller\Admin;

use App\Entity\Comments;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Component\HttpFoundation\Response;

class CommentsController extends AbstractController
{
    /**
     * Index of backend 
     * 
     * @Route("/admin", name="admin_accueil")
     */
    public function index() 
    {
        return $this->render('admin/admin_accueil.html.twig');
    }

    /**
     * Show all comments to website
     * 
     * @Route("/admin/admin_comments", name="admin_comments")
     */
    public function adminComments(CommentsRepository $repository)
    {
        $comments = $repository->findAllInverse();

        return $this->render('admin/comments/admin_comments.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * Delete one comment 
     * 
     * @Route("/admin/delete_comment/{id}", name="delete_comment", methods="POST|GET")
     */
    public function deleteComment(Comments $comment, ObjectManager $manager)
    {
        $manager->remove($comment);
        $manager->flush();
        return $this->render('admin/admin_accueil.html.twig');
    }

  
}

