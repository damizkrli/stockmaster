<?php

namespace App\Controller;

use App\Repository\OutOfStockRepository;
use App\Repository\ProductRepository;
use App\Repository\SupplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        SupplyRepository $supplyRepository,
        OutOfStockRepository $outOfStockRepository,
    ): Response {
        $supplies = $supplyRepository->findBy([], ['addedAt' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'supplies' => $supplies,
        ]);
    }
}