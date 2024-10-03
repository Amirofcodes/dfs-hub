<?php

namespace App\Controller;

use App\Entity\LearningResource;
use App\Form\LearningResourceType;
use App\Repository\LearningResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/learn')]
class LearningResourceController extends AbstractController
{
    #[Route('/', name: 'app_learning_resource_index', methods: ['GET'])]
    public function index(LearningResourceRepository $learningResourceRepository): Response
    {
        return $this->render('learning_resource/index.html.twig', [
            'learning_resources' => $learningResourceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_learning_resource_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $learningResource = new LearningResource();
        $form = $this->createForm(LearningResourceType::class, $learningResource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $learningResource->setAuthor($this->getUser());

            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('learning_resources_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'There was an error uploading the image. Please try again.');
                    return $this->redirectToRoute('app_learning_resource_new');
                }

                $learningResource->setImageFilename($newFilename);
            }

            $entityManager->persist($learningResource);
            $entityManager->flush();

            $this->addFlash('success', 'The learning resource has been created successfully.');
            return $this->redirectToRoute('app_learning_resource_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('learning_resource/new.html.twig', [
            'learning_resource' => $learningResource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_learning_resource_show', methods: ['GET'])]
    public function show(LearningResource $learningResource): Response
    {
        return $this->render('learning_resource/show.html.twig', [
            'learning_resource' => $learningResource,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_learning_resource_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, LearningResource $learningResource, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(LearningResourceType::class, $learningResource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('learning_resources_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'There was an error uploading the image. Please try again.');
                    return $this->redirectToRoute('app_learning_resource_edit', ['id' => $learningResource->getId()]);
                }

                // Delete the old image file if it exists
                if ($learningResource->getImageFilename()) {
                    $oldImagePath = $this->getParameter('learning_resources_directory').'/'.$learningResource->getImageFilename();
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $learningResource->setImageFilename($newFilename);
            }

            $learningResource->setUpdatedAt(new \DateTime());
            $entityManager->flush();

            $this->addFlash('success', 'The learning resource has been updated successfully.');
            return $this->redirectToRoute('app_learning_resource_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('learning_resource/edit.html.twig', [
            'learning_resource' => $learningResource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_learning_resource_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, LearningResource $learningResource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$learningResource->getId(), $request->request->get('_token'))) {
            // Delete the image file if it exists
            if ($learningResource->getImageFilename()) {
                $imagePath = $this->getParameter('learning_resources_directory').'/'.$learningResource->getImageFilename();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $entityManager->remove($learningResource);
            $entityManager->flush();

            $this->addFlash('success', 'The learning resource has been deleted successfully.');
        }

        return $this->redirectToRoute('app_learning_resource_index', [], Response::HTTP_SEE_OTHER);
    }
}
