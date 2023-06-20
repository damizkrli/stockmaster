<?php

namespace App\Controller;

use App\Entity\ProductSerialized;
use App\Form\ProductSerializedType;
use App\Repository\ProductSerializedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[Route('/serialized')]
class ProductSerializedController extends AbstractController
{
    private ProductSerializedRepository $productSerializedRepository;
    private PaginatorInterface          $paginator;
    private EntityManagerInterface      $entityManager;
    private CsrfTokenManagerInterface   $csrfTokenManager;

    public function __construct(
        ProductSerializedRepository $productSerializedRepository,
        PaginatorInterface $paginator,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager,
    ) {
        $this->entityManager = $entityManager;
        $this->productSerializedRepository = $productSerializedRepository;
        $this->paginator = $paginator;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    #[Route('/', name: 'productSerialized', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $productSerialized = new ProductSerialized();
        $form = $this->createForm(ProductSerializedType::class, $productSerialized);
        $form->handleRequest($request);

        $productsQuery = $this->productSerializedRepository->findBy([], ['addedAt' => 'DESC']);

        $productsSerialized = $this->paginator->paginate(
            $productsQuery,
            $request->query->getInt('page', 1),
            10
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $newProductSerialized = $form->getData();

            $this->productSerializedRepository->save($newProductSerialized, true);
            $this->addFlash('success', 'Votre produit sérialisé a été ajouté avec succès.');

            return $this->redirectToRoute('productSerialized', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_serialized/index.html.twig', [
            'productsSerialized' => $productsSerialized,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'productSerialized_show', methods: ['GET', 'POST'])]
    public function show(ProductSerialized $productSerialized): Response
    {
        return $this->render('product_serialized/show.html.twig', [
            'productsSerialized' => $productSerialized,
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_productSerialized', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductSerialized $productSerialized, ProductSerializedRepository $productRepository): Response
    {
        $form = $this->createForm(ProductSerializedType::class, $productSerialized);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->save($productSerialized, true);
            $this->addFlash('success', 'Votre produit a été modifié avec succès.');

            return $this->redirectToRoute('productSerialized', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_serialized/edit.html.twig', [
            'productsSerialized' => $productSerialized,
            'form' => $form,
        ]);
    }

    #[Route('/product/serialized/{id}', name: 'delete_productSerialized', methods: ['POST'])]
    public function delete(Request $request, ProductSerialized $productSerialized, ProductSerializedRepository $productSerializedRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productSerialized->getId(), $request->request->get('_token'))) {
            $productSerializedRepository->remove($productSerialized, true);
            $this->addFlash('success', 'Votre produit a été supprimé avec succès.');
        }

        return $this->redirectToRoute('productSerialized', [], Response::HTTP_SEE_OTHER);
    }
}
