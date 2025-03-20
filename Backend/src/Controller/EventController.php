<?php


// src/Controller/EventController.php

namespace App\Controller;

use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;

class EventController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/events", name="events_index", methods={"GET"})
     */
    public function index(): Response
    {
        $events = $this->entityManager->getRepository(Event::class)->findAll();
        return $this->json($events);
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

        return $this->json($event);
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

            // Assuming you have a way to get the current user
            $user = $this->getUser();
            $event->setOrganizer($user); // Set the organizer field

            $entityManager = $this->entityManager;
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_show', ['id' => $event->getId()]);
        }

        return $this->render('event/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/events/{id}/update", name="event_update", methods={"PUT"})
     */
    public function update(Request $request, Event $event): Response
    {
        $data = json_decode($request->getContent(), true);
        // Update event properties from $data
        $this->entityManager->flush();
        return $this->json($event);
    }

    /**
     * @Route("/events/{id}/delete", name="event_delete", methods={"DELETE"})
     */
    public function delete(Event $event): Response
    {
        $this->entityManager->remove($event);
        $this->entityManager->flush();
        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
