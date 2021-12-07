<?php

namespace App\Controller;

use App\Entity\Investisseur;
use App\Form\InvestisseurType;
use App\Repository\InvestisseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/investisseur")
 */
class InvestisseurController extends AbstractController
{
    /**
     * @Route("/", name="investisseur_index", methods={"GET", "POST"})
     */
    public function index(Request $request, InvestisseurRepository $investisseurRepository): Response
    {
        $query = "";
        $searchForm = $this->createFormBuilder(null)
            ->add('title', TextType::class)
            ->add('search', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])->getForm();
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $query = $searchForm->getData()['title'];
            echo $query;
            return $this->render('investisseur/index.html.twig', [
                'investisseurs' => $investisseurRepository->findBy([
                    'NomSociete' => $query,
                ]),
                'form' => $searchForm->createView(),
            ]);
        }
        return $this->render('investisseur/index.html.twig', [
            'investisseurs' => $investisseurRepository->findAll(),
            'form' => $searchForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="investisseur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $investisseur = new Investisseur();
        $form = $this->createForm(InvestisseurType::class, $investisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($investisseur);
            $entityManager->flush();

            return $this->redirectToRoute('investisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('investisseur/new.html.twig', [
            'investisseur' => $investisseur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="investisseur_show", methods={"GET"})
     */
    public function show(Investisseur $investisseur): Response
    {
        return $this->render('investisseur/show.html.twig', [
            'investisseur' => $investisseur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="investisseur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Investisseur $investisseur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvestisseurType::class, $investisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('investisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('investisseur/edit.html.twig', [
            'investisseur' => $investisseur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="investisseur_delete", methods={"POST"})
     */
    public function delete(Request $request, Investisseur $investisseur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$investisseur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($investisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('investisseur_index', [], Response::HTTP_SEE_OTHER);
    }
}
