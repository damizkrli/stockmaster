<?php

namespace App\Controller;

use App\Entity\Supply;
use App\Form\SupplyType;
use App\Repository\SupplyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/supply')]
class SupplyController extends AbstractController
{
    private SupplyRepository $supplyRepository;
    private PaginatorInterface $paginator;

    public function __construct(
        SupplyRepository $supplyRepository,
        PaginatorInterface $paginator
    ) {
        $this->supplyRepository = $supplyRepository;
        $this->paginator = $paginator;
    }

    #[Route('/', name: 'supply', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $supply = new Supply();
        $form = $this->createForm(SupplyType::class, $supply);
        $form->handleRequest($request);

        $suppliesQuery = $this->supplyRepository->findBy([], ['addedAt' => 'DESC']);

        $supplies = $this->paginator->paginate(
            $suppliesQuery,
            $request->query->getInt('page', 1),
            8
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $newSupply = $form->getData();
            $this->supplyRepository->save($supply, true);
            $this->addFlash('success', 'Votre fourniture à été ajoutée avec succès.');

            return $this->redirectToRoute('supply', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('supply/index.html.twig', [
            'supplies' => $this->supplyRepository->findBy([], ['addedAt' => 'DESC']),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit_supply', methods: ['GET', 'POST'])]
    public function edit(Request $request, Supply $supply, SupplyRepository $supplyRepository): Response
    {
        $form = $this->createForm(SupplyType::class, $supply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supplyRepository->save($supply, true);
            $this->addFlash('success', 'Votre fourniture a été modifiée avec succès.');

            return $this->redirectToRoute('supply', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supply/edit.html.twig', [
            'supply' => $supply,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete_supply', methods: ['POST'])]
    public function delete(Request $request, Supply $supply, SupplyRepository $supplyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supply->getId(), $request->request->get('_token'))) {
            $supplyRepository->remove($supply, true);
        }

        return $this->redirectToRoute('supply', [], Response::HTTP_SEE_OTHER);
    }
}
