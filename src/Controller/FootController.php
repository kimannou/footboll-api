<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FootController extends AbstractController
{
    #[Route('/foot', name: 'app_foot')]
    public function index(): Response
    {
        return $this->render('foot/index.html.twig', [
            'controller_name' => 'FootController',
        ]);
    }
}
