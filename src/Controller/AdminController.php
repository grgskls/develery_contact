<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ContactQuestion;
use App\Entity\User;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/questions', name: 'admin_questions')]
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        //$questions = $entityManager->getRepository(ContactQuestion::class)->findAll();

        $query = $entityManager->getRepository(ContactQuestion::class)->createQueryBuilder('q')
        ->orderBy('q.id', 'DESC')
        ->getQuery();
    
        $pagination = $paginator->paginate(
        $query, // Query to paginate
        $request->query->getInt('page', 1), // Current page number, default is 1
        5 // Number of items per page
        );

        return $this->render('admin/index.html.twig', [
            'pagination' => $pagination,
        ]);

    }

    
    #[Route('/admin/questions/{id}', name: 'admin_delete_question')]
    public function deleteQuestion(EntityManagerInterface $entityManager, int $id): Response
    {
        $question = $entityManager->getRepository(ContactQuestion::class)->find($id);
        $entityManager->remove($question);
        $entityManager->flush();

        $this->addFlash('success', 'Question deleted successfully.');

        return $this->redirectToRoute('admin_questions'); 
    }

    #[Route('/admin/user-manager', name: 'admin_user_manager')]
    public function userManager(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
    
        $query = $entityManager->getRepository(User::class)->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC')
            ->getQuery();
    
        $pagination = $paginator->paginate(
            $query, // Query to paginate
            $request->query->getInt('page', 1), // Current page number, default is 1
            5 // Number of items per page
        );
    
        return $this->render('admin/user_manager.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/admin/save-user-roles', name: 'admin_save_user_roles')]
    public function saveUserRoles(Request $request, EntityManagerInterface $entityManager): Response
{
    $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
    
    $userRepository = $entityManager->getRepository(User::class);
    $users = $userRepository->findAll();

    foreach ($users as $user) {
        if ($user->getUsername() === 'admin') {
            continue;
        }
        
        $isAdmin = $request->request->get('user_roles_' . $user->getId());

        // Get the existing roles and add or remove ROLE_ADMIN based on the checkbox
        $roles = $user->getRoles();
        if ($isAdmin !== null) {
            $roles[] = 'ROLE_ADMIN';
        } else {
            $key = array_search('ROLE_ADMIN', $roles);
            if ($key !== false) {
                unset($roles[$key]);
            }
        }

        $user->setRoles(array_unique($roles));
        $entityManager->persist($user);
    }

    $entityManager->flush();

    $this->addFlash('successMessage', 'User roles saved successfully.');

    return $this->redirectToRoute('admin_user_manager');
}

}
