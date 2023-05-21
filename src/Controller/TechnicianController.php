<?php

namespace App\Controller;

use App\Entity\Technician;
use App\Form\TechnicianType;
use App\Repository\TechnicianRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/technician')]
class TechnicianController extends AbstractController
{
    #[Route('/', name: 'app_technician_index', methods: ['GET'])]
    public function index(TechnicianRepository $technicianRepository): Response
    {
        return $this->render('technician/index.html.twig', [
            'technicians' => $technicianRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_technician_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TechnicianRepository $technicianRepository): Response
    {
        $technician = new Technician();
        $form = $this->createForm(TechnicianType::class, $technician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $technicianRepository->save($technician, true);

            return $this->redirectToRoute('app_technician_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('technician/new.html.twig', [
            'technician' => $technician,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_technician_show', methods: ['GET'])]
    public function show(Technician $technician): Response
    {
        return $this->render('technician/show.html.twig', [
            'technician' => $technician,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_technician_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Technician $technician, TechnicianRepository $technicianRepository): Response
    {
        $form = $this->createForm(TechnicianType::class, $technician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $technicianRepository->save($technician, true);

            return $this->redirectToRoute('app_technician_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('technician/edit.html.twig', [
            'technician' => $technician,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_technician_delete', methods: ['POST'])]
    public function delete(Request $request, Technician $technician, TechnicianRepository $technicianRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technician->getId(), $request->request->get('_token'))) {
            $technicianRepository->remove($technician, true);
        }

        return $this->redirectToRoute('app_technician_index', [], Response::HTTP_SEE_OTHER);
    }
}
