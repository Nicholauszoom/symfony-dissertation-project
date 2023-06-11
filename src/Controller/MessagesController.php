<?php

namespace App\Controller;


use App\Entity\Messages;
use App\Entity\User;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as ConfigurationSecurity;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/messages')]
class MessagesController extends AbstractController
{
// private $security;
    
    #[Route('/', name: 'app_messages_index', methods: ['GET'])]
    public function index(MessagesRepository $messagesRepository ): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // $user = $this->security->getUser();
        // $userId = $user ? $user->getId() :null;

        // if ($userId) {
        //     $message = $messagesRepository->findAllByUserId($userId);
        // } else {
        //     $message = [];
        // }
       
       
        
        return $this->render('messages/index.html.twig', [
            'messages' => $messagesRepository->findAll(),
        ]);
    }



    // #[Route('/new', name: 'app_messages_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, MessagesRepository $messagesRepository): Response
    // {
    //     $message = new Messages();
    //     $form = $this->createForm(MessagesType::class, $message);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $messagesRepository->save($message, true);

    //         return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
    //     }
        

    //     return $this->renderForm('messages/new.html.twig', [
    //         'message' => $message,
    //         'messages' => $messagesRepository->findAll(),
    //         'form' => $form,
    //     ]);
    // }

//current modification
    #[Route('/new', name: 'app_messages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MessagesRepository $messagesRepository): Response
    {

      
        // $this->denyAccessUnlessGranted('ROLE_USER');



        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
 
            // dump($request->request->get('location_latitude'));
            // dump($request->request->get('location_longitude'));


            //  if ($message->getLatitude() !== null) {
            //     $message->setLatitude($request->request->get('latitude'));
            // }

            // if ($message->getLongitude() !== null) {
            //     $message->setLongitude($request->request->get('longitude'));
            // }



           
             // $message->setLatitude($request->request->get('location')['latitude']);
            // $message->setLongitude($request->request->get('location')['longitude']);
            // $message = array(
            //     'latitude' => $request->request->get('location')['latitude'],
            //     'longitude' => $request->request->get('location')['longitude']
            // );


            $message =$form -> getData();
            $imagePath =$form->get('imagePath')->getData();
            if($imagePath){
                $newFileName =uniqid() . '.' . $imagePath->guessExtension();

                try{
                    $imagePath->move(
                        $this -> getParameter('kernel.project_dir') . '/public/uploads', $newFileName);
                }catch(FileException $e){
                    return new Response($e->getMessage());
                }
                $message->setImagePath('/uploads/' . $newFileName);
            }

            $messagesRepository->save($message, true);

            return $this->redirectToRoute('app_messages_new', [], Response::HTTP_SEE_OTHER);
        }
        
            // $messages = $messagesRepository->findAllByUserId($userId);

            // return new Response('Location saved successfully.', Response::HTTP_OK);

        return $this->renderForm('messages/new.html.twig', [
             
            'message' => $message,
            'messages' => $messagesRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_messages_show', methods: ['GET'])]
    public function show(Messages $message): Response
    {
       

        return $this->render('messages/show.html.twig', [
            'message' => $message,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_messages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Messages $message, MessagesRepository $messagesRepository): Response
    {
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messagesRepository->save($message, true);

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('messages/edit.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_messages_delete', methods: ['POST'])]
    public function delete(Request $request, Messages $message, MessagesRepository $messagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $messagesRepository->remove($message, true);
        }

        return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
    }



// //////////////////
// #[Route('/', name: 'app_messages_index', methods: ['GET'])]
// public function index(MessagesRepository $messagesRepository): Response
// {
//     return $this->render('messages/index.html.twig' ,[
//         'messages' => $messagesRepository->findAll(),
//     ]);
// }



#[Route('/accountmessage', name: 'app_messages_By_user_Id',  methods: ['GET'])]
public function getMssgByUserId(MessagesRepository $messagesRepository,Security $security): Response
    {
        $user = $security->getUser();
        $userId = $user ? $user->getId(): null;

        if ($userId) {
            $messages = $messagesRepository->findAllByUserId($userId);
        } else {
            $messages = [];
        }

       

        return $this->renderForm('messages/by_account.html.twig', [
            'messages' =>  $messages,
            
        ]);
    }
}