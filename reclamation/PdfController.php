<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Snappy\Pdf;
//use Mpdf\Mpdf;

class PdfController extends AbstractController
{

    private $pdfService;

    public function __construct(Pdf $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    #[Route('/pdf', name: 'app_pdf')]


// ...
public function pdf() {


    $this->pdfService->setOption('no-outline', true);
    $this->pdfService->setOption('page-size', 'LETTER');
    $this->pdfService->setOption('encoding', 'UTF-8');


        
        $html = $this->renderView('pdf/index.html.twig', array(
            //..Send some data to your view if you need to //
        ));
        
        $filename = 'myFirstSnappyPDF';

        return new Response(
            $this->pdfService->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'.pdf"'
            )
        );
    }
// ...
//$mpdf = new \mPDF();

// Write some HTML code:
//$mpdf->WriteHTML('Hello World');

// Output a PDF file directly to the browser
//$mpdf->Output('mpdf.pdf','D');

}
