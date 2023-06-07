<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Participant;
use App\Form\ConversationType;
use App\Repository\ConversationRepository;
use App\Repository\UserRepository;
use Doctrine\Migrations\Tools\TransactionHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Throwable;

#[Route('/conversation')]
class ConversationController extends AbstractController
{
    private $entityManager;
    private $userRepository;
    
    // private $entityManagerInterface;

public function __construct(UserRepository $userRepository , EntityManagerInterface $entityManagerInterface){
$this->userRepository =$userRepository;
$this->entityManager=$entityManagerInterface;
}


    //  /**
    //   * @param Request $request
    //  * @return JsonResponse
    //  * @throws Exception
    //  */
    // #[Route('/{id}', name: 'app_conversation_index', methods: ['GET'])]
    // public function index(ConversationRepository $conversationRepository ,Request $request, int $id): Response
    // {
    //     // return $this->render('conversation/index.html.twig', [
    //     //     'conversations' => $conversationRepository->findAll(),
    //     // ]);
    //     $otherUser =$request->get('otherUser', 0);
    //     $otherUser =$this->userRepository->find($id);


    //     if(is_null($otherUser)){
    //         // throw new \Exception("The user was not found");

    //         throw new Exception("The user was not found");
            
            

            
    //     }

    //     if ($otherUser->getId() === $this->getUser()->getId()){
    //         // throw new \Exception("That is deep but you cannot create a conversation with that ");
    //         throw new Exception("That is deep but you cannot create a conversation with that" );
            
    //     }



    //     // check if conversation alredy exists
    //    $conversation = $this->$conversationRepository->findConversationByParticipants(

    //     $otherUser->getId(),
    //     $this->getUser()->getId()
    //    );
      
    //    if(count($conversation)){
    //     // throw new \ErrorException("conersasion LREDY EXIST");
    //     throw new Exception("conersasion LREDY EXIST");
        
    //    }

    //    $conversation = new Conversation();
    //    $participants =new Participant();
    //    $participants->setUser($this->getUser());
    //    $participants->setConversation($conversation);


       
    //    $otherparticipants =new Participant();
    //    $otherparticipants->setUser($otherUser);
    //    $otherparticipants->setConversation($conversation);


    //  $this->entityManager->getConnection()->beginTransaction();

    //  try{
    //     $this->entityManager->persist($conversation);
    //     $this->entityManager->persist($participants);
    //     $this->entityManager->persist($otherparticipants);


    //     $this->entityManager->flush();

    //     $this->entityManager->commit();


    //  }catch(Exception $e){
    //     $this->entityManager->rollback();
        
    //     throw $e;
         
    //  }

    // //  $this->entityManagerEnterface->commit();

    //     return $this->json([
    //         'id'=> $conversation->getId() 
    //     ], Response::HTTP_CREATED ,[] ,[]);
    // }

    #[Route('/new', name: 'app_conversation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConversationRepository $conversationRepository): Response
    {
        $conversation = new Conversation();
        $form = $this->createForm(ConversationType::class, $conversation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conversationRepository->save($conversation, true);

            return $this->redirectToRoute('app_conversation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conversation/new.html.twig', [
            'conversation' => $conversation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conversation_show', methods: ['GET'])]
    public function show(Conversation $conversation): Response
    {
        return $this->render('conversation/show.html.twig', [
            'conversation' => $conversation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conversation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conversation $conversation, ConversationRepository $conversationRepository): Response
    {
        $form = $this->createForm(ConversationType::class, $conversation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conversationRepository->save($conversation, true);

            return $this->redirectToRoute('app_conversation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conversation/edit.html.twig', [
            'conversation' => $conversation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conversation_delete', methods: ['POST'])]
    public function delete(Request $request, Conversation $conversation, ConversationRepository $conversationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conversation->getId(), $request->request->get('_token'))) {
            $conversationRepository->remove($conversation, true);
        }

        return $this->redirectToRoute('app_conversation_index', [], Response::HTTP_SEE_OTHER);
    }
}
