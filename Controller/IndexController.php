<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/about.html', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('index/about.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/activity-list-1', name: 'app_activity-list-1')]
    public function activitylist1(): Response
    {
        return $this->render('index/activity-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/activity-single', name: 'app_activity-single')]
    public function activitysingle(): Response
    {
        return $this->render('index/activity-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/become-expert.html', name: 'app_become-expert')]
    public function becomeexpert(): Response
    {
        return $this->render('index/become-expert.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/blog-list-1.html', name: 'app_blog-list-1')]
    public function bloglist1(): Response
    {
        return $this->render('index/blog-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/blog-list-2.html', name: 'app_blog-list-2')]
    public function bloglist2(): Response
    {
        return $this->render('index/blog-list-2.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/blog-single.html', name: 'app_blog-single')]
    public function bloglistsiingle(): Response
    {
        return $this->render('index/blog-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/booking-pages', name: 'app_booking-pages')]
    public function bookingpages(): Response
    {
        return $this->render('index/booking-pages.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/car-list-1', name: 'app_car-list-1')]
    public function carlist1(): Response
    {
        return $this->render('index/car-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/cruise-list-1.html', name: 'app_cruise-list-1')]
    public function cruiselist1(): Response
    {
        return $this->render('index/cruise-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/cruise-single', name: 'app_cruise-single')]
    public function cruisesingle(): Response
    {
        return $this->render('index/cruise-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-booking', name: 'app_db-booking')]
    public function dbbooking(): Response
    {
        return $this->render('back/db-booking.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-dashboard0', name: 'app_db-dashboard0')]
    public function dbdashboard(): Response
    {
        return $this->render('back/db-dashboard.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-settings', name: 'app_db-settings')]
    public function dbsettings(): Response
    {
        return $this->render('back/db-settings.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-wishlist', name: 'app_db-wishlist')]
    public function dbwishlist(): Response
    {
        return $this->render('back/db-wishlist.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/destinations', name: 'app_destinations')]
    public function destinations(): Response
    {
        return $this->render('index/destinations.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/flights-list', name: 'app_flights-list')]
    public function flightslist(): Response
    {
        return $this->render('index/flights-list.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/hotel-list-1', name: 'app_hotel-list-1')]
    public function hotellist1(): Response
    {
        return $this->render('index/hotel-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/hotel-single-1', name: 'app_hotel-single-1')]
    public function hotelsingle1(): Response
    {
        return $this->render('index/hotel-single-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/rental-list-1', name: 'app_rental-list-1')]
    public function rentallist1(): Response
    {
        return $this->render('index/rental-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/rental-single', name: 'app_rental-single')]
    public function rentalsingle(): Response
    {
        return $this->render('index/rental-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/signup', name: 'app_signup')]
    public function signup(): Response
    {
        return $this->render('index/signup.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/terms', name: 'app_terms')]
    public function terms(): Response
    {
        return $this->render('index/terms.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/tour-list-1', name: 'app_tour-list-1.')]
    public function tourlist1(): Response
    {
        return $this->render('index/tour-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/ui-elements', name: 'app_ui-elements.')]
    public function uielemenst(): Response
    {
        return $this->render('index/ui-elements.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact0(): Response
    {
        return $this->render('index/contact.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/db-vendor-dashboard', name: 'app_db-vendor-dashboard')]
    public function vendoraddDashboard(): Response
    {
        return $this->render('back/db-vendor-dashboard.html.twig', [
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
