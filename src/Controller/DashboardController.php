<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
    /**
     * @Route("/dashboard/projet", name="dashboard_projet")
     */
    public function projets(): Response
    {
        return $this->forward('App\Controller\ProjetController::index');
        // return $this->render('dashboard/index.html.twig', [
        //     'controller_name' => 'DashboardController',
        // ]);
    }
}
