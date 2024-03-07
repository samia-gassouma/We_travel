<?php

namespace App\Controller;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;
use App\Entity\Reclamation;
use App\Entity\Utilisateur;
use App\Form\ReclamationType;
use App\Repository\ReservationRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\ReclamationRepository;
use App\Repository\ReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/contact/{id}', name: 'app_contact')]
    public function contact(Request $request,ManagerRegistry $doctrine,$id,UtilisateurRepository $uR, ReclamationRepository $rR,Recaptcha3Validator $recaptcha3Validator, PaginatorInterface $paginator)
    {
       // $session = $request->getSession();
        //$session->set('description', '');
        $em= $doctrine->getManager();
        $reclamation = new Reclamation();

        $reclamation->setStatut("en attente");
        $user=$uR->find($id);
        $reclamation->setClient($user);
       // $reclamation->setDate(new \DateTime());
        $reclamation->setDate_Envoi(new \DateTime('now'));
        $form=$this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if($form->isSubmitted() &&$form->isValid())//
            {
 
               // $this->addFlash( 'notice','Your changes were saved!');
    notyf()
     ->position('x', 'center')
     ->position('y', 'top')
     ->addSuccess('Your application has been received.');
    
    $em->persist($reclamation);
    $em->flush();
                
            //return $this->redirectToRoute("app_blank");
                //$score = $recaptcha3Validator->getLastResponse()->getScore();
                //dump($form->getErrors(true, false), $form->isValid());
                //dd($form->getData());
               // $this->get('form.factory')->createNamed($form->getName(), ReclamationType::class);
                //$form->setData(null);    
                //return new Response($reclamation>getId().'yes');
                    //$this->redirectToRoute('app_blank');
                    //$form=$this->createForm(ReclamationType::class, $reclamation);

            }
            else if($form->isSubmitted() && !$form->isValid())
            {
                notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('There was an error, check your form.');
            }
            $query=$rR->findByClient($id);//replace by the example 
            $list = $paginator->paginate(
                // Doctrine Query, not results
                $query,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                5
            );
            //dump($form->getData());
        return $this->renderForm('index/ui-elements.html.twig', [
            'form' => $form,
            'list'=>$list,
            'id' =>$id,
            'title' => "Formulaire"
        ]);
    }
    
    #[Route('/reponse/{id_r}', name: 'app_voir_reponse')]
    public function get_reponse($id_r,ReclamationRepository $rR, ReponseRepository $repR): Response
    {
        $reclamation=$rR->find($id_r);//replace by the example 
        $reponse=$repR->findByReclamation($id_r);//replace by the example 
       // $request = $this->getRequest();
      //  $x=$this->request->query->get('type');
        return $this->render('index/reponse.html.twig', [
            'r' => $reclamation,
            'reponse' => $reponse,
        ]);
    }

    #[Route('/reclamation/edit/{id}/{id_r}', name: 'app_reclamation_edit')]
    public function edit ($id,$id_r,Request $request,EntityManagerInterface $em, ReclamationRepository $rR) 
    {
        $reclamation = $rR->find($id_r);
        $reclamation->setDate($reclamation->getDate());
        $reclamation->setType($reclamation->getType());
        $reclamation->setDescription($reclamation->getDescription());
        $reclamation->setReservation($reclamation->getReservation());
        $reclamation->setPaiement($reclamation->getPaiement());
        $reclamation->setStatut($reclamation->getStatut());
        $form=$this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) 
        {
            $em->persist($reclamation);
            $em->flush();
            notyf()
     ->position('x', 'center')
     ->position('y', 'top')
     ->addSuccess('Your changes have been saved.');
            return $this->redirectToRoute('app_contact',['id' => $id]);
        } 
        else if($form->isSubmitted() && !$form->isValid())
            {
                notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('There was an error, check your form.');
            }
        $list=null;
            $list=$rR->findByClient($id);//replace by the example 
        return $this->renderForm("index/ui-elements.html.twig",
        ['form'=>$form,
        'title'=>"Editer réclamation",
        'list'=>$list,
        'id' =>$id,]);     
    }
    
    #[Route('/reclamation/remove/{id}/{id_r}', name: 'app_reclamation_remove')]
    public function remove($id,$id_r,EntityManagerInterface $em,ReclamationRepository $rR) 
    {
        $reclamation=$rR->find($id_r);
        $em->remove($reclamation);
        $em->flush();
        return $this->RedirectToRoute('app_contact',['id' => $id]);
    }

    #[Route('/blank', name: 'app_blank')]
    public function blank(): Response
    {
        
       // $request = $this->getRequest();
      //  $x=$this->request->query->get('type');
        return $this->render('index/blank.html.twig', [
            //'x' => $x,
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
        return $this->render('index/db-booking.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-dashboard0', name: 'app_db-dashboard0')]
    public function dbdashboard(): Response
    {
        return $this->render('index/db-dashboard.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-settings', name: 'app_db-settings')]
    public function dbsettings(): Response
    {
        return $this->render('index/db-settings.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/db-wishlist', name: 'app_db-wishlist')]
    public function dbwishlist(): Response
    {
        return $this->render('index/db-wishlist.html.twig', [
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

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('index/login.html.twig', [
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
    









    


}
