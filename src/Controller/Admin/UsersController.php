<?php
namespace App\Controller\Admin;

use App\Entity\Users;
use App\Service\PaginationService;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Manager the users 
 */
class UsersController extends AdminController
{
    /**
     * Index of administration users
     * 
     * @Route("/admin/admin_users/{page}", name="admin_users")
     * 
     * @param PaginationService $pagination
     * @param $page
     * 
     * @return Response
     */
    public function adminUsers(PaginationService $pagination, $page = 1): Response
    {
        $pagination->setEntityClass(Users::class)
                   ->setCurrentPage($page)
                   ->setLimit(5);

        return $this->render('admin/users/admin_users.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Delete one user
     * 
     * @Route("/admin/delete_user/{id}", name="delete_user", methods="POST|GET")
     * 
     * @param Users $user
     * 
     * @return Response
     */
    public function deleteUser(Users $user): Response
    {
        $this->manager->remove($user);
        $this->manager->flush();
        return $this->render('admin/admin_accueil.html.twig');
    }

    /**
     * Update role to an user (ROLE_ADMIN or ROLE_USER)
     * 
     * @Route("/admin/update_user/{id}", name="update_user", methods="POST|GET")
     * 
     * @param Users $user
     * 
     * @return Response
     */
    public function updateRole(Users $user): Response
    {
        $role = $user->getRoles();
        $new_role = ($role[0] === 'ROLE_USER') ? 'ROLE_ADMIN' : 'ROLE_USER';

        $user->setRoles($new_role);
        $this->manager->flush();
        
        return $this->json([
            'role' => $user->getRoles()
        ], 200);
    }
}

