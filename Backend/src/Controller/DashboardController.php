<?php
// src/Controller/DashboardController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $title = 'Dashboard visiteur';

        if ($user instanceof UserInterface) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $title = 'Dashboard administrateur de ' . $user->getUserIdentifier();
            } elseif ($this->isGranted('ROLE_USER')) {
                $title = 'Dashboard de ' . $user->getUserIdentifier();
            }
        }

        return $this->render('dashboard/index.html.twig', [
            'title' => $title,
        ]);
    }
}
