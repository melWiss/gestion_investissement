<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $users = $entityManager->getRepository(User::class)->findAll();
            if (sizeof($users) == 0) {
                $role = new Role();
                $role->setTitle("ROLE_ADMIN");
                $entityManager->persist($role);
                $entityManager->flush();
                $user->setRoles([$role->getTitle()]);
            } else {
                $roles = $entityManager->getRepository(Role::class)->findAll();
                if (sizeof($roles) <= 1) {
                    $role = new Role();
                    $role->setTitle("ROLE_USER");
                    $entityManager->persist($role);
                    $entityManager->flush();
                    $user->setRoles([$role->getTitle()]);
                }else{
                    $role = $entityManager->getRepository(Role::class)->find(1);
                    $user->setRoles([$role->getTitle()]);
                }
            }
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
