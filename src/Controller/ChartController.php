<?php

namespace App\Controller;

use App\Entity\Chart;
use App\Form\ChartType;
use App\Repository\ChartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chart')]
class ChartController extends AbstractController
{
    #[Route('/', name: 'app_chart_index', methods: ['GET'])]
    public function index(ChartRepository $chartRepository): Response
    {
        return $this->render('chart/index.html.twig', [
            'charts' => $chartRepository->findAll(),
        ]);
    }



    

    #[Route('/new', name: 'app_chart_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChartRepository $chartRepository): Response
    {
        $chart = new Chart();
        $form = $this->createForm(ChartType::class, $chart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chartRepository->save($chart, true);

            return $this->redirectToRoute('app_chart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chart/new.html.twig', [
            'chart' => $chart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chart_show', methods: ['GET'])]
    public function show(Chart $chart): Response
    {
        return $this->render('chart/show.html.twig', [
            'chart' => $chart,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chart_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chart $chart, ChartRepository $chartRepository): Response
    {
        $form = $this->createForm(ChartType::class, $chart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chartRepository->save($chart, true);

            return $this->redirectToRoute('app_chart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chart/edit.html.twig', [
            'chart' => $chart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chart_delete', methods: ['POST'])]
    public function delete(Request $request, Chart $chart, ChartRepository $chartRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chart->getId(), $request->request->get('_token'))) {
            $chartRepository->remove($chart, true);
        }

        return $this->redirectToRoute('app_chart_index', [], Response::HTTP_SEE_OTHER);
    }
}
