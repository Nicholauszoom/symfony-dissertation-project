<?php

namespace App\Controller;

use App\Entity\IndexDetail;
use App\Form\IndexDetailType;
use App\Repository\IndexDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/index/detail')]
class IndexDetailController extends AbstractController
{
    #[Route(['/','/detail'], name: 'app_index_detail_index', methods: ['GET'])]
    public function index(IndexDetailRepository $indexDetailRepository): Response
    {
        return $this->render('index_detail/index.html.twig', [
            'index_details' => $indexDetailRepository->findAll(),
        ]);
    }

    #[Route('detail/new', name: 'app_index_detail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IndexDetailRepository $indexDetailRepository): Response
    {
        $indexDetail = new IndexDetail();
        $form = $this->createForm(IndexDetailType::class, $indexDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $indexDetailRepository->save($indexDetail, true);

            return $this->redirectToRoute('app_index_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('index_detail/new.html.twig', [
            'index_detail' => $indexDetail,
            'form' => $form,
        ]);
    }

    #[Route('index/detail/{id}', name: 'app_index_detail_show', methods: ['GET'])]
    public function show(IndexDetail $indexDetail): Response
    {
        return $this->render('index_detail/show.html.twig', [
            'index_detail' => $indexDetail,
        ]);
    }

    #[Route('index/detail/{id}/edit', name: 'app_index_detail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, IndexDetail $indexDetail, IndexDetailRepository $indexDetailRepository): Response
    {
        $form = $this->createForm(IndexDetailType::class, $indexDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $indexDetailRepository->save($indexDetail, true);

            return $this->redirectToRoute('app_index_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('index_detail/edit.html.twig', [
            'index_detail' => $indexDetail,
            'form' => $form,
        ]);
    }

    #[Route('/index/detail/{id}', name: 'app_index_detail_delete', methods: ['POST'])]
    public function delete(Request $request, IndexDetail $indexDetail, IndexDetailRepository $indexDetailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$indexDetail->getId(), $request->request->get('_token'))) {
            $indexDetailRepository->remove($indexDetail, true);
        }

        return $this->redirectToRoute('app_index_detail_index', [], Response::HTTP_SEE_OTHER);
    }
}
