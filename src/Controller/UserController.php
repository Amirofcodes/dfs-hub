<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('You need to be logged in to access this page.');
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
