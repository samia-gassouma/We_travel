<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EventFormType;
use symfony\Component\OptionsResolver\OptionsResolver;

class EventController extends AbstractController
{   

    private $EventRepository;    //badel ism repository haseb ism classe 

    public function __construct(EventRepository $EventRepository)//kifkif
{
    $this->EventRepository = $EventRepository;//kifkif
}


#[Route('/Event', name: 'app_Event_list')]
public function index(): Response
{
$testers = $this->EventRepository->findAll();//badel ism repository
return $this->render('Event/index.html.twig', [  //selon l ism ili 3tahoulik w tbadel index haseb chnowa taht
    'testers' => $testers,
]);
}

#[Route ('/Event/form/new', name: "app_form_new")]
public function newEventForm(EntityManagerInterface $em, Request $req)
{
    $Event = new Event();  //test titbadel bi esm il classe 
    $form = $this->createForm(EventFormType::class, $Event); //testformtype titbadel
    $form->handleRequest($req);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($Event);  //thot ism il controlleur
        $em->flush();
        return $this->redirectToRoute('app_Event_list');  //titbadel delon ism controlleur
    }

    return $this->renderForm('Event/addEditForm.html.twig', [  
        'formAdd' => $form
    ]);
}


#[Route('/Event/delete/{id}', name:"app_Event_delete")]
    public function deleteEvent($id, EntityManagerInterface $em,EventRepository $aR) 
    {
        $Event=$aR->find($id);
        $em->remove($Event);
        $em->flush();
        return $this->redirectToRoute("app_Event_list");
    }


    #[Route ('/Event/form/edit/{id}',name:"app_form_new_edit1")]
    public function editEventForm( $id,EventRepository $aR, Request $req , EntityManagerInterface $em){
        $Event=$aR->find($id);
        $Event->setType($Event->gettype());
        $Event->setDatedebut($Event->getDatedebut());
        $Event->setDatefin($Event->getDatefin());
        $Event->setLieux($Event->getLieux());
        $Event->setPrix($Event->getPrix());
        $form=$this->createForm(EventFormType::class,$Event);//tbadel testformtype
        $form->handleRequest($req);
        if($form->isSubmitted())
        {
            $em->persist($Event);  
            $em->flush();
            return $this->redirectToRoute('app_Event_list');//hot app w ism il controlleur
        }
        return $this->renderform('Event/addEditForm.html.twig',  
        ['formAdd'=>$form]);
    }


   
}
