<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataUserController extends AbstractController
{
    #[Route('/data/user', name: 'app_data_user')]
    public function index(): Response
    {
        return $this->render('data_user/index.html.twig', [
            'controller_name' => 'DataUserController',
        ]);
    }
}
