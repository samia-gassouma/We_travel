<?php
namespace App\Controller;

use App\Entity\Hotels;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\HotelsRepository;


class HotelController extends AbstractController
{
    #[Route('/hotels', name: 'hotel_list')]
    public function list(Request $request, HotelsRepository $hotelsRepository): Response
    {
        $sortBy = $request->query->get('sortBy', 'name');
        $searchTerm = $request->query->get('q');

        // Si un terme de recherche est fourni, utilisez la méthode de recherche
        if ($searchTerm !== null) {
            $hotels = $hotelsRepository->search($searchTerm);
        } else {
            // Sinon, utilisez la méthode de tri par défaut
            $hotels = $hotelsRepository->findAllOrderedBy($sortBy);
        }

        return $this->render('front/hotel-list-1.html.twig', [
            'hotels' => $hotels,
            'sortBy' => $sortBy,
            'searchTerm' => $searchTerm
        ]);
    }
    #[Route('/hotel/{id}', name: 'hotel_details')]
    public function details($id): Response
    {

        $hotel = $this->getDoctrine()->getRepository(Hotels::class)->find($id);
        dump($hotel);
        return $this->render('front/hotel-single-1.html.twig', [
            'hotel' => $hotel,

            
        ]);
    }

    

}
