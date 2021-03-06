<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    
    /**
     * @Route("/dashboard/", name="dashboard_projet")
     */
    public function index(): Response
    {
        return $this->forward('App\Controller\ProjetController::index');
        // return $this->render('dashboard/index.html.twig', [
        //     'controller_name' => 'DashboardController',
        // ]);
    }
}
