<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Voyage;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VoyageFormType;
use Knp\Component\Pager\PaginatorInterface;
use symfony\Component\OptionsResolver\OptionsResolver;
use Endroid\QrCode\QrCode;


class VoyageController extends AbstractController
{
    private $VoyageRepository;    //badel ism repository haseb ism classe 

    public function __construct(VoyageRepository $VoyageRepository)//kifkif
{
    $this->VoyageRepository = $VoyageRepository;//kifkif
}


#[Route('/Voyage', name: 'app_Voyage_list')]
public function index(): Response
{
$testers = $this->VoyageRepository->findAll();//badel ism repository
return $this->render('Voyage/index.html.twig', [  //selon l ism ili 3tahoulik w tbadel index haseb chnowa taht
    'testers' => $testers,
]);
}

#[Route ('/Voyage/form/new', name: "app_form_new1")]
public function newVoyageForm(EntityManagerInterface $em, Request $req)
{
    $Voyage = new Voyage();  //test titbadel bi esm il classe 
    $form = $this->createForm(VoyageFormType::class, $Voyage); //testformtype titbadel
    $form->handleRequest($req);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($Voyage);  //thot ism il controlleur
        $em->flush();
        notyf()
        ->position('x', 'center')
        ->position('y', 'top')
        ->addSuccess('voyage has bee added');
        return $this->redirectToRoute('app_Voyage_list');  //titbadel delon ism controlleur
    }

    return $this->renderForm('Voyage/addEditForm.html.twig', [  
        'formAdd' => $form
    ]);
}


#[Route('/Voyage/delete/{id}', name:"app_Voyage_delete")]
    public function deleteVoyage($id, EntityManagerInterface $em,VoyageRepository $aR) 
    {
        $Voyage=$aR->find($id);
        $em->remove($Voyage);
        $em->flush();
        notyf()
        ->position('x', 'center')
        ->position('y', 'top')
        ->addSuccess('voyage has bee deleted');
        return $this->redirectToRoute("app_Voyage_list");
    }


    #[Route ('/Voyage/form/edit/{id}',name:"app_form_new_edit7")]
    public function editVoyageForm( $id,VoyageRepository $aR, Request $req , EntityManagerInterface $em){
        $Voyage=$aR->find($id);
        $form=$this->createForm(VoyageFormType::class,$Voyage);//tbadel testformtype
        $form->handleRequest($req);
        if($form->isSubmitted())
        {
            $em->persist($Voyage);  
            $em->flush();
            notyf()
        ->position('x', 'center')
        ->position('y', 'top')
        ->addSuccess('voyage has bee modified');
            return $this->redirectToRoute('app_Voyage_list');//hot app w ism il controlleur
        }
        return $this->renderform('Voyage/addEditForm.html.twig',  
        ['formAdd'=>$form]);
    }

    #[Route('/voyage-list', name: 'app_voyage-list')]
public function voyagelist(Request $request, PaginatorInterface $paginator): Response
{
    $testers = $this->VoyageRepository->findAll();

    // Paginer les résultats
    $testers = $paginator->paginate(
        $testers, // Requête à paginer (ici, la liste de tous les voyages)
        $request->query->getInt('page', 1), // Numéro de page par défaut
        6 // Nombre d'éléments par page
    );

    return $this->render('voyage/voyage-list.html.twig', [
        'testers' => $testers,
    ]);
}



}