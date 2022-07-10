<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocialMediaController extends AbstractController
{
    #[Route('/social/media', name: 'app_social_media')]
    public function index(): Response
    {
        return $this->render('social_media/index.html.twig', [
            'controller_name' => 'SocialMediaController',
        ]);
    }
}
