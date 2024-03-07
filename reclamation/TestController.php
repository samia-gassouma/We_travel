<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Test;
use App\Form\TestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $test=new Test();
        $form=$this->createForm(TestType::class, $test);
        $form->handleRequest($request);
        if($form->isSubmitted())//
            {
                $em->persist($test);
                $em->flush();
                dd($form->getData());
            }
        return $this->renderForm('test/index.html.twig', [
            'form' => $form
        ]);
    }
}
