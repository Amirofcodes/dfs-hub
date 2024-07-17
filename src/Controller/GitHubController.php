<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GitHubController extends AbstractController
{
    #[Route('/connect/github', name: 'connect_github_start')]
    public function connectAction(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry
            ->getClient('github')
            ->redirect([
                'user:email', // the scopes you want to access
            ]);
    }

    #[Route('/connect/github/check', name: 'connect_github_check')]
    public function connectCheckAction(): Response
    {
        // This method will not be executed, as the authenticator will handle this
        return new Response('This should not be reached!');
    }
}
