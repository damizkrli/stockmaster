<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    private ProductRepository      $productRepository;
    private PaginatorInterface     $paginator;
    private EntityManagerInterface $entityManager;

    public function __construct(
        ProductRepository $productRepository,
        PaginatorInterface $paginator,
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
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

    #[Route('/{id}', name: 'product_show', methods: ['GET', 'POST'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'products' => $product,
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

    #[Route('/product/{id}', name: 'delete_product', methods: ['POST'])]
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $quantity = $request->request->get('quantity');
            if ($quantity && $quantity > 0) {
                $removedQuantity = min($quantity, $product->getQuantity());
                $product->decreaseQuantity($removedQuantity); // Supprime la quantité spécifiée d'unités du produit
                $this->entityManager->flush();

                if ($removedQuantity === $product->getQuantity()) {
                    $this->addFlash('success', 'Votre produit a été supprimé.');
                } else {
                    if ($removedQuantity === 1) {
                        $this->addFlash('success', $removedQuantity.' produit à été supprimé.');
                    } else {
                        $this->addFlash('success', $removedQuantity.' produits ont été supprimés.');
                    }
                }
            }
        }

        return $this->redirectToRoute('product', [], Response::HTTP_SEE_OTHER);
    }
}
