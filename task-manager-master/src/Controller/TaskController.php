<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/tasks', methods: ['POST'])]
    public function createTask(Request $request, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);

        $task = new Task();
        $task->setTitle($data['title']);
        $task->setDescription($data['description'] ?? '');
        $task->setDeadline(new \DateTime($data['deadline']));
        $task->setCompleted(false);

        $em->persist($task);
        $em->flush();

        return $this->json(['status' => 'Task created', 'task' => $task], Response::HTTP_CREATED);
    }

    #[Route('/tasks', methods: ['GET'])]
    public function getTasks(): Response
    {
        $tasks = $this->entityManager->getRepository(Task::class)->findAll();

        $tasksArray = array_map(function ($task) {
            return [
                'id' => $task->getId(),
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'deadline' => $task->getDeadline()->format('Y-m-d H:i:s'),
                'completed' => $task->isCompleted(),
            ];
        }, $tasks);

        return new JsonResponse($tasksArray, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/tasks/{id}', methods: ['PATCH'])]
    public function updateTask(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $task = $em->find(Task::class, $id);
        if (!$task) {
            return $this->json(['error' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['title'])) {
            $task->setTitle($data['title']);
        }
        if (isset($data['description'])) {
            $task->setDescription($data['description']);
        }
        if (isset($data['deadline'])) {
            $task->setDeadline(new \DateTime($data['deadline']));
        }
        if (isset($data['completed'])) {
            $task->setCompleted($data['completed']);
        }

        $em->flush();

        return $this->json(['status' => 'Task updated', 'task' => $task]);
    }

    #[Route('/tasks/{id}', methods: ['DELETE'])]
    public function deleteTask(EntityManagerInterface $em, int $id): Response
    {
        $task = $em->find(Task::class, $id);
        if (!$task) {
            return $this->json(['error' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        $em->remove($task);
        $em->flush();

        return $this->json(['status' => 'Task deleted']);
    }

}
