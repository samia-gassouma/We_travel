<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/about.html', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('front/about.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/activity-list-1', name: 'app_activity-list-1')]
    public function activitylist1(): Response
    {
        return $this->render('front/activity-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/activity-single', name: 'app_activity-single')]
    public function activitysingle(): Response
    {
        return $this->render('front/activity-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/become-expert.html', name: 'app_become-expert')]
    public function becomeexpert(): Response
    {
        return $this->render('front/become-expert.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/blog-list-1.html', name: 'app_blog-list-1')]
    public function bloglist1(): Response
    {
        return $this->render('front/blog-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/blog-list-2.html', name: 'app_blog-list-2')]
    public function bloglist2(): Response
    {
        return $this->render('front/blog-list-2.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/blog-single.html', name: 'app_blog-single')]
    public function bloglistsiingle(): Response
    {
        return $this->render('front/blog-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/booking-pages', name: 'app_booking-pages')]
    public function bookingpages(): Response
    {
        return $this->render('front/booking-pages.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/car-list-1', name: 'app_car-list-1')]
    public function carlist1(): Response
    {
        return $this->render('front/car-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/cruise-list-1.html', name: 'app_cruise-list-1')]
    public function cruiselist1(): Response
    {
        return $this->render('front/cruise-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/cruise-single', name: 'app_cruise-single')]
    public function cruisesingle(): Response
    {
        return $this->render('front/cruise-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-booking', name: 'app_db-booking')]
    public function dbbooking(): Response
    {
        return $this->render('front/db-booking.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-dashboard0', name: 'app_db-dashboard0')]
    public function dbdashboard(): Response
    {
        return $this->render('front/db-dashboard.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-settings', name: 'app_db-settings')]
    public function dbsettings(): Response
    {
        return $this->render('front/db-settings.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-wishlist', name: 'app_db-wishlist')]
    public function dbwishlist(): Response
    {
        return $this->render('front/db-wishlist.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/destinations', name: 'app_destinations')]
    public function destinations(): Response
    {
        return $this->render('front/destinations.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    

    #[Route('/hotel-list-1', name: 'app_hotel-list-1')]
    public function hotellist1(): Response
    {
        return $this->render('front/hotel-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/hotel-single-1', name: 'app_hotel-single-1')]
    public function hotelsingle1(): Response
    {
        return $this->render('front/hotel-single-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('front/login.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/rental-list-1', name: 'app_rental-list-1')]
    public function rentallist1(): Response
    {
        return $this->render('front/rental-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/rental-single', name: 'app_rental-single')]
    public function rentalsingle(): Response
    {
        return $this->render('front/rental-single.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/signup', name: 'app_signup')]
    public function signup(): Response
    {
        return $this->render('front/signup.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/terms', name: 'app_terms')]
    public function terms(): Response
    {
        return $this->render('front/terms.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/tour-list-1', name: 'app_tour-list-1.')]
    public function tourlist1(): Response
    {
        return $this->render('front/tour-list-1.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/ui-elements', name: 'app_ui-elements.')]
    public function uielemenst(): Response
    {
        return $this->render('front/ui-elements.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact0(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/contact', name: 'app_flight')]
    public function flight(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/contact', name: 'app_flights-list')]
    public function flights(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
