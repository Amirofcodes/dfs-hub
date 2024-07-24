<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserActivity;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('You need to be logged in to access this page.');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Your profile has been updated.');

            return $this->redirectToRoute('app_user');
        }

        $activities = $entityManager->getRepository(UserActivity::class)->findBy(
            ['user' => $user],
            ['createdAt' => 'DESC'],
            10
        );

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'activities' => $activities,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/upload-profile-picture', name: 'app_user_upload_profile_picture', methods: ['POST'])]
    public function uploadProfilePicture(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('You need to be logged in to upload a profile picture.');
        }

        $profilePicture = $request->files->get('profile_picture');

        if ($profilePicture) {
            $originalFilename = pathinfo($profilePicture->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $profilePicture->guessExtension();

            try {
                $profilePicture->move(
                    $this->getParameter('profile_pictures_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
            }

            $user->setProfilePicture($newFilename);
            $entityManager->flush();

            $this->addFlash('success', 'Profile picture uploaded successfully!');
        }

        return $this->redirectToRoute('app_user');
    }
}
