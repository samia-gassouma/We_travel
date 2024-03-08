<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HebergementRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hebergement;
use Symfony\Component\HttpFoundation\Request;
use App\Form\HebergementFormType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Voyage;
use App\Repository\VoyageRepository;


    class HebergementController extends AbstractController
    {
        private $HebergementRepository;    //badel ism repository haseb ism classe 

        public function __construct(HebergementRepository $HebergementRepository)//kifkif
    {
        $this->HebergementRepository = $HebergementRepository;//kifkif
    }


    #[Route('/Hebergement', name: 'app_Hebergement_list')]
    public function index(): Response
    {
    $testers = $this->HebergementRepository->findAll();//badel ism repository
    return $this->render('hebergement/index.html.twig', [  //selon l ism ili 3tahoulik w tbadel index haseb chnowa taht
        'testers' => $testers,
    ]);
    }



    #[Route('/Hebergement/form/new', name: "app_form_new_hebergment")]
    public function newHebergementForm(EntityManagerInterface $em, Request $req)
    {
        $Hebergement = new Hebergement();
        $form = $this->createForm(HebergementFormType::class, $Hebergement);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $em->persist($Hebergement);
            $em->flush();

            // Redirection ou autre action
            return $this->redirectToRoute('app_Hebergement_list');
        }

        return $this->render('Hebergement/addEditForm.html.twig', [
            'formAdd' => $form->createView(),

        ]);
    }



    #[Route('/Hebergement/delete/{id}', name:"app_Hebergement_delete")]
    public function deleteHebergement($id, EntityManagerInterface $em,HebergementRepository $aR) 
    {
        $Hebergement=$aR->find($id);
        $em->remove($Hebergement);
        $em->flush();
        notyf()
        ->position('x', 'center')
        ->position('y', 'top')
        ->addSuccess('hotel has bee deleted');
        return $this->redirectToRoute("app_Hebergement_list");
        
    }


    #[Route ('/Hebergement/form/edit/{id}',name:"app_form_new_edit")]
    public function editHebergementForm( $id,HebergementRepository $aR, Request $req , EntityManagerInterface $em){
        $Hebergement=$aR->find($id);
        $form=$this->createForm(HebergementFormType::class,$Hebergement);//tbadel testformtype
        $form->handleRequest($req);
        if($form->isSubmitted())
        {
            $em->persist($Hebergement);  
            $em->flush();
            notyf()
        ->position('x', 'center')
        ->position('y', 'top')
        ->addSuccess('hotel has bee modified');
            return $this->redirectToRoute('app_Hebergement_list');//hot app w ism il controlleur
        }
        return $this->renderform('Hebergement/addEditForm.html.twig',  
        ['formAdd'=>$form]);
    }



    #[Route('/Hebergement/list/{id}', name: 'app_Hebergement-list')]
    public function listH($id): Response
    {
        // Fetch hotels associated with the specific voyage ID
        $voyage = $this->getDoctrine()->getRepository(Voyage::class)->find($id);

        // Check if the voyage exists
        if (!$voyage) {
            throw $this->createNotFoundException('Voyage not found');
        }

        // Fetch hotels associated with the voyage
        $hotels = $voyage->getHebergements();

        return $this->render('hebergement/listHebergement.html.twig', [
            'testers' => $hotels,
        ]);
    }

    #[Route('/Hebergement/all', name: 'app_Hebergement-list')]
    public function listall(): Response
    {
        $testers = $this->HebergementRepository->findAll();//badel ism repository
        return $this->render('hebergement/hebergementall.html.twig', [  //selon l ism ili 3tahoulik w tbadel index haseb chnowa taht
            'testers' => $testers,
        ]);
    }

    

}
