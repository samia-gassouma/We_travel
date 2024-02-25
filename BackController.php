<?php

namespace App\Controller;


use App\Repository\ReclamationRepository;
use App\Repository\ReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ReponseType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reponse;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Mailer\MailerInterface;

class BackController extends AbstractController
{
    #[Route('/db_dashboard', name: 'app_db_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('back/db-dashboard.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db_booking', name: 'app_db_booking')]
    public function booking(): Response
    {
        return $this->render('back/db-booking.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }



    #[Route('/db_afficher_reclamation', name: 'app_afficher_reclamation')]
    public function afficher_reclamation(ReclamationRepository $rR): Response
    {
        $list=$rR->findAll();//replace by the example 
        
        return $this->render('back/db_afficher_reclamation.html.twig', [
            'controller_name' => 'BackController',
            'list'=>$list,
        ]);
    }

    #[Route('/db_afficher_reclamation2/{messageId}', name: 'app_afficher_reclamation2')]
    public function afficher_reclamation2($messageId,EntityManagerInterface $em,ReclamationRepository $rR): Response
    {
        $reclamation=$rR->find($messageId);//replace by the example 
        $reclamation->setStatut("en cours");
        $em->persist($reclamation);
        $em->flush();
        return $this->render('back/db-dashboard.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/db_afficher_reponse', name: 'app_afficher_reponse')]
    public function afficher_reponse(ReponseRepository $rR): Response
    {$list=null;
            $list=$rR->findAll();//replace by the example 
            //dump($form->getData());

        return $this->render('back/db_afficher_reponse.html.twig', [
            'controller_name' => 'BackController',
            'list'=>$list,
        ]);
    }

    #[Route('/db_ajouter_reponse/{id}', name: 'app_ajouter_reponse')]
    public function ajouter_reponse($id,Request $request,ManagerRegistry $doctrine,ReclamationRepository $rR): Response
    {

        $em= $doctrine->getManager();
        $reponse = new Reponse();

        $reclamation=$rR->find($id);
        $reclamation->setStatut("en cours");
        $em->persist($reclamation);
        $em->flush();
        $reponse->setReclamation($reclamation);
        $reponse->setDate(new \DateTime('now'));
        $form=$this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);
        if($form->isSubmitted() )//&&$form->isValid()
            {
                $em->persist($reponse);
                $em->flush();
                $reclamation->setStatut("résolu");
                $em->persist($reclamation);
                $em->flush();
              //  $score = $recaptcha3Validator->getLastResponse()->getScore();
               // $this->get('form.factory')->createNamed($form->getName(), ReclamationType::class);
                //$form->setData(null);    
                //return new Response($reclamation>getId().'yes');
                   // $this->redirectToRoute('app_blank');
                    //$form=$this->createForm(ReclamationType::class, $reclamation);
                    return $this->redirectToRoute('app_db-vendor-dashboard');

            }
            //$list=null;
           // $list=$rR->findByClient($id);//replace by the example 
            //dump($form->getData());
        return $this->renderForm('back/db_ajouter_reponse.html.twig', [
            'form' => $form,
            //'list'=>$list,
        ]);
    }

    #[Route('/reponse/edit/{id}', name: 'app_reponse_edit')]
    public function edit ($id,Request $request,EntityManagerInterface $em, ReponseRepository $rR) 
    {
        $reponse = $rR->find($id);
        $reponse->setDate($reponse->getDate());
        $reponse->setContenu($reponse->getContenu());
        $reponse->setEtat($reponse->getEtat());
        $reponse->setReclamation($reponse->getReclamation());
        $form=$this->createForm(ReponseType::class,$reponse);
        $form->handleRequest($request);
        if($form->isSubmitted()) 
        {
            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute('app_afficher_reponse');
        } 
        return $this->renderForm("back/db_ajouter_reponse.html.twig",
        ['form'=>$form,
        'title'=>"Editer réponse"]);     
    }
    
    #[Route('/reponse/remove/{id}', name: 'app_reponse_remove')]
    public function remove($id,EntityManagerInterface $em,ReponseRepository $rR) 
    {
        $reponse=$rR->find($id);
        $em->remove($reponse);
        $em->flush();
        return $this->RedirectToRoute('app_afficher_reponse');
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

    #[Route('/db_vendor_dashboard', name: 'app_db-vendor-dashboard')]
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
