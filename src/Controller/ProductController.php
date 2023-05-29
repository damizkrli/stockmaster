<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    private ProductRepository $productRepository;
    private PaginatorInterface $paginator;

    public function __construct(
        ProductRepository $productRepository,
        PaginatorInterface $paginator
    ) {
        $this->productRepository = $productRepository;
        $this->paginator = $paginator;
    }

    #[Route('/', name: 'product', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        $productsQuery = $this->productRepository->findBy([], ['addedAt' => 'DESC']);

        $products = $this->paginator->paginate(
            $productsQuery,
            $request->query->getInt('page', 1),
            10
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $newProduct = $form->getData();
            $this->productRepository->save($newProduct, true);
            $this->addFlash('success', 'Votre produit a été ajouté avec succès.');

            return $this->redirectToRoute('product', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit_product', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->save($product, true);
            $this->addFlash('success', 'Votre produit a été modifié avec succès.');

            return $this->redirectToRoute('product', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'products' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete_product', methods: ['POST'])]
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product, true);
            $this->addFlash('success', 'Votre produit a été supprimé avec succès.');
        }

        return $this->redirectToRoute('product', [], Response::HTTP_SEE_OTHER);
    }
}
