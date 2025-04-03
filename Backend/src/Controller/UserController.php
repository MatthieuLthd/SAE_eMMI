<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Event;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/users/{id}/activate", name="user_activate", methods={"POST"})
     */
    public function activate(int $id): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        $user->setIsActive(true);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_dashboard');
    }

    /**
     * @Route("/users/{id}/deactivate", name="user_deactivate", methods={"POST"})
     */
    public function deactivate(int $id): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        $user->setIsActive(false);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_dashboard');
    }

    /**
     * @Route("/users/{id}/delete", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, int $id): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard');
    }


    // ============================        API REST        =================================== //


    // Renvoie les events d'un utilisateur
    /**
     * @Route("/api/users/{id}/events", name="api_user_events", methods={"GET"})
     */
    public function getUserEvents(int $id, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $userEvents = $entityManager->getRepository(Event::class)->findBy(['organizer' => $user]);
        $data = $serializer->serialize($userEvents, 'json', ['groups' => 'event:read']);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    // Renvoie tous les utilisateurs
    /**
     * @Route("/api/users", name="api_users", methods={"GET"})
     */
    public function getUsers(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $users = $entityManager->getRepository(User::class)->findAll();
        $data = $serializer->serialize($users, 'json', ['groups' => 'user:read']);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/users/me", name="api_user_me", methods={"GET"})
     */
    public function getCurrentUser(SerializerInterface $serializer): JsonResponse
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'No user is currently logged in'], Response::HTTP_UNAUTHORIZED);
        }

        // Sérialiser les données de l'utilisateur
        $data = $serializer->serialize($user, 'json', ['groups' => 'user:read']);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }


}