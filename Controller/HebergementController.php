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
use symfony\Component\OptionsResolver\OptionsResolver;



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

#[Route ('/Hebergement/form/new', name: "app_form_new_hebergment")]
public function newHebergementForm(EntityManagerInterface $em, Request $req)
{
    $Hebergement = new Hebergement();  //test titbadel bi esm il classe 
    $form = $this->createForm(HebergementFormType::class, $Hebergement); //testformtype titbadel
    $form->handleRequest($req);

    if ($form->isSubmitted() && $form->isValid()) {
        
        $em->persist($Hebergement);  //thot ism il controlleur
        $em->flush();
        return $this->redirectToRoute('app_Hebergement_list');  //titbadel delon ism controlleur
    }

    return $this->renderForm('Hebergement/addEditForm.html.twig', [  
        'formAdd' => $form
    ]);
}


#[Route('/Hebergement/delete/{id}', name:"app_Hebergement_delete")]
    public function deleteHebergement($id, EntityManagerInterface $em,HebergementRepository $aR) 
    {
        $Hebergement=$aR->find($id);
        $em->remove($Hebergement);
        $em->flush();
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
            return $this->redirectToRoute('app_Hebergement_list');//hot app w ism il controlleur
        }
        return $this->renderform('Hebergement/addEditForm.html.twig',  
        ['formAdd'=>$form]);
    }

}
