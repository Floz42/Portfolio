<?php
namespace App\Controller\Admin;

use App\Entity\Comments;
use App\Service\PaginationService;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Manage the comments 
 */
class CommentsController extends AdminController
{
    /**
     * Index of backend 
     * 
     * @Route("/admin", name="admin_accueil")
     * 
     * @return Response
     */
    public function index(): Response 
    {
        return $this->render('admin/admin_accueil.html.twig');
    }

    /**
     * Show all comments to website
     * 
     * @Route("/admin/admin_comments/{page}", name="admin_comments")
     * 
     * @param PaginationService $pagination
     * @param Int $page
     * 
     * @return Response
     */
    public function adminComments(PaginationService $pagination, int $page = 1): Response
    {
        $pagination->setEntityClass(Comments::class)
                   ->setCurrentPage($page);

        return $this->render('admin/comments/admin_comments.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Delete one comment 
     * 
     * @Route("/admin/delete_comment/{id}", name="delete_comment", methods="POST|GET")
     * 
     * @param Comments $comment
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function deleteComment(Comments $comment): Response
    {
        $this->manager->remove($comment);
        $this->manager->flush();
        return $this->render('admin/admin_accueil.html.twig');
    }

  
}

