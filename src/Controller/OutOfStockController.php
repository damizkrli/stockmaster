<?php

namespace App\Controller;

use App\Entity\OutOfStock;
use App\Form\OutOfStockType;
use App\Repository\OutOfStockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/out/of/stock')]
class OutOfStockController extends AbstractController
{
    #[Route('/', name: 'app_out_of_stock_index', methods: ['GET'])]
    public function index(OutOfStockRepository $outOfStockRepository): Response
    {
        return $this->render('out_of_stock/index.html.twig', [
            'out_of_stocks' => $outOfStockRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_out_of_stock_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OutOfStockRepository $outOfStockRepository): Response
    {
        $outOfStock = new OutOfStock();
        $form = $this->createForm(OutOfStockType::class, $outOfStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outOfStockRepository->save($outOfStock, true);

            return $this->redirectToRoute('app_out_of_stock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('out_of_stock/new.html.twig', [
            'out_of_stock' => $outOfStock,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_out_of_stock_show', methods: ['GET'])]
    public function show(OutOfStock $outOfStock): Response
    {
        return $this->render('out_of_stock/show.html.twig', [
            'out_of_stock' => $outOfStock,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_out_of_stock_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OutOfStock $outOfStock, OutOfStockRepository $outOfStockRepository): Response
    {
        $form = $this->createForm(OutOfStockType::class, $outOfStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outOfStockRepository->save($outOfStock, true);

            return $this->redirectToRoute('app_out_of_stock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('out_of_stock/edit.html.twig', [
            'out_of_stock' => $outOfStock,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_out_of_stock_delete', methods: ['POST'])]
    public function delete(Request $request, OutOfStock $outOfStock, OutOfStockRepository $outOfStockRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outOfStock->getId(), $request->request->get('_token'))) {
            $outOfStockRepository->remove($outOfStock, true);
        }

        return $this->redirectToRoute('app_out_of_stock_index', [], Response::HTTP_SEE_OTHER);
    }
}
