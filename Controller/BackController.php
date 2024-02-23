<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    #[Route('/db-dashboard', name: 'app_db-dashboard')]
    public function dashboard(): Response
    {
        return $this->render('back/db-dashboard.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-booking', name: 'app_db-booking')]
    public function booking(): Response
    {
        return $this->render('back/db-booking.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-settings', name: 'app_db-settings')]
    public function settings(): Response
    {
        return $this->render('back/db-settings.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-wishlist', name: 'app_db-wishlist')]
    public function wishlist(): Response
    {
        return $this->render('back/db-wishlist.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-vendor-add-hotel', name: 'app_db-vendor-add-hotel')]
    public function vendoraddHotel(): Response
    {
        return $this->render('back/db-vendor-add-hotel.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-vendor-booking', name: 'app_db-vendor-booking')]
    public function vendoraddBooking(): Response
    {
        return $this->render('back/db-vendor-booking.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-vendor-dashboard', name: 'app_db-vendor-dashboard')]
    public function vendoraddDashboard(): Response
    {
        return $this->render('back/db-vendor-dashboard.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-vendor-hotels', name: 'app_db-vendor-hotels')]
    public function vendoraddDashHotels(): Response
    {
        return $this->render('back/db-vendor-hotels.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db-vendor-recovery', name: 'app_db-vendor-recovery')]
    public function vendoraddRecovery(): Response
    {
        return $this->render('back/db-vendor-recovery.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }
}
