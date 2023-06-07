<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/task')]
class TaskController extends AbstractController
{

    #[Route('/', name: 'app_task_index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findAll(),
        ]); 
    }

    #[Route('/new', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new( MailerInterface $mailer ,Request $request, TaskRepository $taskRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
         $email = (new Email())
            ->from('nicholaussomi5@gmail.com')
            ->to($task->getTechn())
            ->subject('HelpDesk support system ,You have assigned a new task')
            ->text('You have assigned new task to conduct for more info visit our official website https:\\localhost:8000
             THANK YOU!
            ');

        $mailer ->send($email);    

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }

      
        return $this->renderForm('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('task/edit.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_delete', methods: ['POST'])]
    public function delete(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $taskRepository->remove($task, true);
        }

        return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    }





    // #[Route('/{id}/get', name: 'app_task_technician', methods: ['POST'])]
    // public function  findAllByTechnicianId(TaskRepository $taskRepository,$technId ,Security $security):Response
    // {
    //    $technician=$security->getTech


    //     return $this->render('technician/technician_get_task.html.twig', [
    //         'tasks_id' => $taskRepository->findAllByTechnicianId($technId),
    //     ]); 
    // }


////////////////
    // public function getTaskByTechId(MessageRepository $messageRepository, Security $security): Response
    // {
    //     $user = $security->getUser();
    //     $userId = $user ? $user->getId() : null;

    //     if ($userId) {
    //         $messages = $messageRepository->findAllByUserId($userId);
    //     } else {
    //         $messages = [];
    //     }

    //     return $this->render('default/index.html.twig', [
    //         'messages' => $messages,
    //     ]);
    // }



    

}
