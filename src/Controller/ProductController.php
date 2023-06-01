<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/delete', name: 'delete_product', methods: ['POST'])]
    public function delete(Request $request, ProductRepository $productRepository): JsonResponse
    {
        $productIds = $request->request->get('ids', []);
        $csrfToken = $request->request->get('_token');

        // Vérifier si le jeton CSRF est valide
        if ($this->isCsrfTokenValid('delete_product', $csrfToken)) {
            foreach ($productIds as $productId) {
                $product = $productRepository->find($productId);

                if ($product) {
                    $productRepository->remove($product, true);
                }
            }

            $this->addFlash('success', 'Les produits ont été supprimés avec succès.');

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Erreur lors de la suppression des produits.']);
    }
}
