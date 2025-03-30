<?php
// src/Controller/DashboardController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $title = 'Dashboard visiteur';

        if ($user instanceof UserInterface) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $title = 'Dashboard administrateur de ' . $user->getUserIdentifier();
                // Récupérer les utilisateurs depuis la base de données
                $users = $entityManager->getRepository(User::class)->findAll();
                // Récupérer les statistiques
                $eventCount = $entityManager->getRepository(Event::class)->count([]);
                $userCount = $entityManager->getRepository(User::class)->count([]);
            } elseif ($this->isGranted('ROLE_USER')) {
                $title = 'Dashboard de ' . $user->getUserIdentifier();
            }
        }

        // Récupérer les événements depuis la base de données
        $events = $entityManager->getRepository(Event::class)->findAll();

        // Récupérer les événements créés par l'utilisateur connecté
        $userEvents = $entityManager->getRepository(Event::class)->findBy(['organizer' => $user]);

        return $this->render('dashboard/index.html.twig', [
            'title' => $title,
            'events' => $events, // Passer les événements à la vue
            'userEvents' => $userEvents, // Passer les événements de l'utilisateur à la vue
            'users' => $users ?? [], // Passer les utilisateurs à la vue si l'utilisateur est un administrateur
            'eventCount' => $eventCount ?? 0, // Passer le nombre d'événements à la vue
            'userCount' => $userCount ?? 0, // Passer le nombre d'utilisateurs à la vue
        ]);
    }

// ============================        API REST        =================================== //


    // Renvoie tous les events avec toutes les infos
    /**
     * @Route("/api/events", name="api_events", methods={"GET"})
     */
    public function getEvents(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $events = $entityManager->getRepository(Event::class)->findAll();
        $data = $serializer->serialize($events, 'json', ['groups' => 'event:read']);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    
    // Renvoie toutes les statistiques
    /**
     * @Route("/api/statistics", name="api_statistics", methods={"GET"})
     */
    public function getStatistics(EntityManagerInterface $entityManager): JsonResponse
    {
        $eventCount = $entityManager->getRepository(Event::class)->count([]);
        $userCount = $entityManager->getRepository(User::class)->count([]);

        $statistics = [
            'eventCount' => $eventCount,
            'userCount' => $userCount,
        ];

        return new JsonResponse($statistics, Response::HTTP_OK);
    }
}