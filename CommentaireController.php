<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentaireRepository;//selon nty chnowa samit il controlleur
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commentaire;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentaireFormType;
use symfony\Component\OptionsResolver\OptionsResolver;


class CommentaireController extends AbstractController
{
private $CommentaireRepository;    //badel ism repository haseb ism classe 

    public function __construct(CommentaireRepository $CommentaireRepository)//kifkif
{
    $this->CommentaireRepository = $CommentaireRepository;//kifkif
}


    
    #[Route('/Commentaire', name: 'app_Commentaire_list')]
    public function index2(EntityManagerInterface $em, Request $req): Response
{
    $commentaire = new Commentaire();  
    $form = $this->createForm(CommentaireFormType::class, $commentaire); 
    $form->handleRequest($req);
    $testers = $this->CommentaireRepository->findAll();

    if ($form->isSubmitted() && $form->isValid()) {
        $commentaire->setDate(new \DateTime());
        $em->persist($commentaire);  
        $em->flush();
        return $this->redirectToRoute('app_Commentaire_list');  
    }

    return $this->renderForm('Commentaire/index2.html.twig', [  
        
        'testers' => $testers,
        'formAdd' => $form,
    ]);
}

#[Route ('/Commentaire/form/new', name: "app_form_new1")]
public function newCommentaireForm(EntityManagerInterface $em, Request $req)
{
    $Commentaire = new Commentaire();  //test titbadel bi esm il classe 
    $form = $this->createForm(CommentaireFormType::class, $Commentaire); //testformtype titbadel
    $form->handleRequest($req);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($Commentaire);  //thot ism il controlleur
        $em->flush();
        return $this->redirectToRoute('app_Commentaire_list');  //titbadel delon ism controlleur
    }

    return $this->renderForm('Commentaire/addEditForm.html.twig', [  
        'formAdd' => $form
        
    ]);
}


#[Route ('/Commentaire/form/edit/{id}',name:"app_form_new_edit2")]
public function editCommentaireForm( $id,CommentaireRepository $aR, Request $req , EntityManagerInterface $em){
    $Commentaire=$aR->find($id);
    $form=$this->createForm(CommentaireFormType::class,$Commentaire);//tbadel testformtype
    $form->handleRequest($req);
    $testers = $this->CommentaireRepository->findAll();
    if($form->isSubmitted())
    {
        $em->persist($Commentaire);  // Persiste l'entité Commentaire dans la base de données
        $em->flush(); // Applique les changements dans la base de données
        return $this->redirectToRoute('app_Commentaire_list');//hot app w ism il controlleur
    }
    return $this->renderForm('Commentaire/index2.html.twig', [  
        
        'testers' => $testers,
        'formAdd' => $form,
    ]);
}

#[Route('/Commentaire/delete/{id}', name:"app_Commentaire_delete")]
    public function deleteCommentaire($id, EntityManagerInterface $em,CommentaireRepository $aR) 
    {
        $Commentaire=$aR->find($id);
        $em->remove($Commentaire);
        $em->flush();
        return $this->redirectToRoute("app_Commentaire_list");
    }


   

















   
}
   