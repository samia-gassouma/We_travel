<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Hotels;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    
    #[Route('/reservation/{hotelId}', name: 'reservation_page')]
    public function reserve(Request $request, $hotelId): Response
    {
        $reservation = new Reservation();   
        $form = $this->createForm(ReservationType::class, $reservation);
        $hotel = $this->getDoctrine()->getRepository(Hotels::class)->find($hotelId);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotel = $this->getDoctrine()->getRepository(Hotels::class)->find($hotelId);
           

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            
            return $this->redirectToRoute('success_page');
        }

        return $this->render('front/reservation.html.twig', [
            'form' => $form->createView(),
            'hotel'=>$hotel,
            'hotelId' => $hotelId,
        ]);
    }
}
