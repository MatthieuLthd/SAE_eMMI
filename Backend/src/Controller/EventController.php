<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Form\EventType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EventController extends AbstractController
{
    private $entityManager;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/events", name="events_index", methods={"GET"})
     */
    public function index(): Response
    {
        $events = $this->entityManager->getRepository(Event::class)->findAll();
        return $this->json($events, 200, [], ['groups' => 'event:read']);
    }

    /**
     * @Route("/events/{id}", name="event_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException('The event does not exist');
        }

        $jsonContent = $this->serializer->serialize($event, 'json', ['groups' => 'event:read']);

        return new Response($jsonContent, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/events/create", name="event_create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setCreatedAt(new \DateTime()); // Set the created_at field

            $this->entityManager->persist($event);
            $this->entityManager->flush();

            return $this->redirectToRoute('event_show', ['id' => $event->getId()]);
        }

        return $this->render('event/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/events/{id}/update", name="event_update", methods={"GET", "POST"})
     */
    public function update(Request $request, int $id): Response
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException('The event does not exist');
        }

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('event/update.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }

    /**
     * @Route("/events/{id}/delete", name="event_delete", methods={"POST"})
     */
    public function delete(Request $request, int $id): Response
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException('The event does not exist');
        }

        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($event);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard');
    }


    // ============================        API REST        =================================== //

    /**
     * @Route("/api/events/{id}", name="api_event_show", methods={"GET"})
     */
    public function apiShow(int $id): Response
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            return $this->json(['error' => 'The event does not exist'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($event, Response::HTTP_OK, [], ['groups' => 'event:read']);
    }

    /**
     * @Route("/api/events", name="api_event_create", methods={"POST"})
     */
    public function apiCreate(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $event = new Event();
        $event->setTitle($data['title'] ?? null);
        $event->setDescription($data['description'] ?? null);
        $event->setLocation($data['location'] ?? null);
        $event->setDate(new \DateTime($data['date'] ?? 'now'));
        $event->setCreatedAt(new \DateTime());

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        return $this->json($event, Response::HTTP_CREATED, [], ['groups' => 'event:read']);
    }

    /**
     * @Route("/api/events/{id}", name="api_event_update", methods={"PUT"})
     */
    public function apiUpdate(Request $request, int $id): Response
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            return $this->json(['error' => 'The event does not exist'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $event->setTitle($data['title'] ?? $event->getTitle());
        $event->setDescription($data['description'] ?? $event->getDescription());
        $event->setLocation($data['location'] ?? $event->getLocation());
        $event->setDate(new \DateTime($data['date'] ?? $event->getDate()->format('Y-m-d H:i:s')));
        $event->setUpdatedAt(new \DateTime());

        $this->entityManager->flush();

        return $this->json($event, Response::HTTP_OK, [], ['groups' => 'event:read']);
    }

    /**
     * @Route("/api/events/{id}", name="api_event_delete", methods={"DELETE"})
     */
    public function apiDelete(int $id): Response
    {
        $event = $this->entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            return $this->json(['error' => 'The event does not exist'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($event);
        $this->entityManager->flush();

        return $this->json(['message' => 'Event deleted successfully'], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/eventRegister", name="api_event_register", methods={"POST"})
     */
    public function apiRegister(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        // Vérifiez que les champs requis sont présents
        if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
            return $this->json(['error' => 'Username, email, and password are required'], Response::HTTP_BAD_REQUEST);
        }

        // Vérifiez si un utilisateur avec le même nom d'utilisateur ou email existe déjà
        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['username' => $data['username']]);
        $existingEmail = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);

        if ($existingUser) {
            return $this->json(['error' => 'The username is already taken'], Response::HTTP_CONFLICT);
        }

        if ($existingEmail) {
            return $this->json(['error' => 'The email is already registered'], Response::HTTP_CONFLICT);
        }

        // Créez un nouvel utilisateur
        $user = new User();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));

        // Persistez l'utilisateur dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();

        // Retournez une réponse JSON
        return $this->json([
            'message' => 'User registered successfully',
            'user' => [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
            ],
        ], Response::HTTP_CREATED);
    }
}