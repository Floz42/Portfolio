<?php
namespace App\Controller\Admin;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as ObjectManager;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends AbstractController
{

    /**
     * @Route("/admin_users", name="admin_users")
     */
    public function adminUsers(UsersRepository $repository)
    {
        $users = $repository->findAllInverse();

        return $this->render('admin/users/admin_users.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/delete_user/{id}", name="delete_user", methods="POST|GET")
     */
    public function deleteComment(Users $user, ObjectManager $manager): Response
    {

        $manager->remove($user);
        $manager->flush();
        return $this->json([
            'id' => $user->getId(),
        ],200); 
    }

    /**
     * @Route("/update_user/{id}", name="update_user", methods="POST|GET")
     */
    public function updateRole(Users $user, ObjectManager $manager): Response
    {
        $role = $user->getRoles();
        $new_role = ($role[0] === 'ROLE_USER') ? 'ROLE_ADMIN' : 'ROLE_USER';

        $user->setRoles($new_role);
        $manager->flush();
        
        return $this->json([
            'role' => $user->getRoles()
        ], 200);
    }

  
}

