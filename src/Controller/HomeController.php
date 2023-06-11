<?php

namespace App\Controller;

use App\Repository\OutOfStockRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductSerializedRepository;
use App\Repository\SupplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private SupplyRepository $supplyRepository;
    private OutOfStockRepository $outOfStockRepository;
    private ProductRepository $productRepository;
    private ProductSerializedRepository $productSerializedRepository;

    public function __construct(
        SupplyRepository $supplyRepository,
        OutOfStockRepository $outOfStockRepository,
        ProductRepository $productRepository,
        ProductSerializedRepository $productSerializedRepository
    ) {
        $this->productRepository = $productRepository;
        $this->supplyRepository = $supplyRepository;
        $this->outOfStockRepository = $outOfStockRepository;
        $this->productSerializedRepository = $productSerializedRepository;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $products = $this->productRepository->findBy([], ['addedAt' => 'DESC']);
        $productsSerialized = $this->productSerializedRepository->findBy([], ['addedAt' => 'DESC']);
        $outOfStock = $this->outOfStockRepository->findBy([], ['addedAt' => 'DESC']);
        $supplies = $this->supplyRepository->findBy([], ['addedAt' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'productsSerialized' => $productsSerialized,
            'outOfStocks' => $outOfStock,
            'supplies' => $supplies,
        ]);
    }
}
