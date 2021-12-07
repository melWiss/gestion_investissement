<?php

namespace App\Controller;

use App\Entity\Convention;
use App\Form\ConventionType;
use App\Repository\ConventionRepository;
use App\Repository\InvestisseurRepository;
use App\Repository\ProjetRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class UserIndexController extends AbstractController
{
    /**
     * @Route("/index", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user_index/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    /**
     * @Route("/projet", name="projet_user_index", methods={"GET"})
     */
    public function projet(ProjetRepository $projetRepository): Response
    {
        return $this->render('projet/index.html.twig', [
            'projets' => $projetRepository->findAll(),
        ]);
    }
    /**
     * @Route("/convention", name="convention_user_index", methods={"GET"})
     */
    public function convention(ConventionRepository $conventionRepository): Response
    {
        return $this->render('convention/index.html.twig', [
            'conventions' => $conventionRepository->findAll(),
        ]);
    }
    /**
     * @Route("/investisseur", name="investisseur_user_index", methods={"GET"})
     */
    public function investisseur(InvestisseurRepository $investisseurRepository): Response
    {
        return $this->render('investisseur/index.html.twig', [
            'investisseurs' => $investisseurRepository->findAll(),
        ]);
    }

    
}
