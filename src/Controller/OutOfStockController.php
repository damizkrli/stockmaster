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
    private OutOfStockRepository $outOfStockRepository;

    public function __construct(OutOfStockRepository $outOfStockRepository)
    {
        $this->outOfStockRepository = $outOfStockRepository;
    }

    #[Route('/', name: 'out_of_stock', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $outOfStock = new OutOfStock();
        $form = $this->createForm(OutOfStockType::class, $outOfStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->outOfStockRepository->save($outOfStock, true);

            return $this->redirectToRoute('out_of_stock', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('out_of_stock/index.html.twig', [
            'out_of_stocks' => $this->outOfStockRepository->findBy([], ['addedAt' => 'DESC']),
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit_out_of_stock', methods: ['GET', 'POST'])]
    public function edit(Request $request, OutOfStock $outOfStock, OutOfStockRepository $outOfStockRepository): Response
    {
        $form = $this->createForm(OutOfStockType::class, $outOfStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outOfStockRepository->save($outOfStock, true);

            return $this->redirectToRoute('out_of_stock', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('out_of_stock/edit.html.twig', [
            'out_of_stock' => $outOfStock,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete_out_of_stock', methods: ['POST'])]
    public function delete(Request $request, OutOfStock $outOfStock, OutOfStockRepository $outOfStockRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outOfStock->getId(), $request->request->get('_token'))) {
            $outOfStockRepository->remove($outOfStock, true);
        }

        return $this->redirectToRoute('out_of_stock', [], Response::HTTP_SEE_OTHER);
    }
}
