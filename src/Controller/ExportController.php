<?php

namespace App\Controller;

use App\Entity\OutOfStock;
use App\Entity\Product;
use App\Entity\ProductSerialized;
use App\Entity\Supply;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/export-product-pdf', name: 'export_product_pdf')]
    public function exportProductToPdf(): Response
    {
        $data = $this->entityManager->getRepository(Product::class)->findAll();

        $html = $this->renderView('export/product_pdf.html.twig', [
            'data' => $data,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Portrait');
        $dompdf->render();

        return new Response($dompdf->output(), Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="export.pdf"',
        ]);
    }

    #[Route('/export-productserialized-pdf', name: 'export_product_pdf')]
    public function exportProductSerializedToPdf(): Response
    {
        $data = $this->entityManager->getRepository(ProductSerialized::class)->findAll();

        $html = $this->renderView('export/productserialized_pdf.html.twig', [
            'data' => $data,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Portrait');
        $dompdf->render();

        return new Response($dompdf->output(), Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="export.pdf"',
        ]);
    }

    #[Route('/export-out-of-stock-pdf', name: 'export_out_of_stock_pdf')]
    public function exportOutOfStockToPdf(): Response
    {
        $data = $this->entityManager->getRepository(OutOfStock::class)->findAll();

        $html = $this->renderView('export/out_of_stock_pdf.html.twig', [
            'data' => $data,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Portrait');
        $dompdf->render();

        return new Response($dompdf->output(), Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="export_hors_stock.pdf"',
        ]);
    }

    #[Route('/export-supply-pdf', name: 'export_supply_pdf')]
    public function supplyPdf(): Response
    {
        $data = $this->entityManager->getRepository(Supply::class)->findBy([], ['addedAt' => 'ASC']);

        $html = $this->renderView('export/supply_pdf.html.twig', [
            'data' => $data,
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Portrait');
        $dompdf->render();

        return new Response($dompdf->output(), Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="export_hors_stock.pdf"',
        ]);
    }
}
