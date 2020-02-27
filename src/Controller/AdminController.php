<?php
namespace App\Controller;

use App\Entity\Comments;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_accueil")
     */
    public function index() 
    {
        return $this->render('admin/admin_accueil.html.twig');
    }

    /**
     * @Route("/admin_comments", name="admin_comments")
     */
    public function adminComments(CommentsRepository $repository)
    {
        $comments = $repository->findAllInverse();

        return $this->render('admin/comments/admin_comments.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/delete_comment/{id}", name="delete_comment", methods="SUP")
     */
    public function deleteComment(Comments $comments, ObjectManager $manager, Request $request)
    {
        if ($this->isCsrfTokenValid("SUP".$comments->getId(), $request->get("_token"))) {
            $manager->remove($comments);
            $manager->flush();
            $this->addFlash('success', 'Le commentaire a bien été supprimé.');
            return $this->redirectToRoute(('admin_comments'));
        }
    }

  
}

