<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\EditProfileUserType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Controller\SerializerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractController
{
    #[Route('/admin/registre', name: 'app_db-vendor-add-admin')]
    
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher,EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_ADMIN']);
            $entityManager->persist($user);
            $entityManager->flush();
                notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addSuccess('Vous avez ajouter un admin avec success');
            //return $this->redirectToRoute('app_db-vendor-afficher-admin');
            
        }
         else
         {
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('Erreur a l ajoutement');
         }

        return $this->render('back/db-vendor-add-admin.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/admin/afficher', name: 'app_db-vendor-afficher-admin')]
    public function afficher(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('back/afficher_Table_Admin.html.twig', [
            'controller_name' => 'GestionController',
            'users'=> $users,
        ]);
    }
    #[Route('/admin/delete/{id}', name: 'app_delete_User')]
    public function delete($id, EntityManagerInterface $entityManager,UserRepository $userRepository)
    {
    $user = $userRepository->find($id);
    $entityManager->remove($user);
    $entityManager->flush();
    notyf()
     ->position('x', 'center')
    ->position('y', 'top')
    ->addSuccess('Vous avez supprimer un admin avec success');
    return $this->redirectToRoute('app_db-vendor-afficher-admin');
    }
    #[Route('/admin/edit/{id}', name: 'app_edit_User')]
    public function edit(EntityManagerInterface $em,Request $req,$id,UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(RegistrationFormType::class,$user);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $em->persist($user);
            $em->flush();
            notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('Vous avez modifié un admin avec success');
            return $this->redirectToRoute('app_db-vendor-afficher-admin');
        }
        else
        {
            notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addError('Erreur a la modification');
        }

        return $this->render('back/db-vendor-add-admin.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/user/profieEdit', name: 'app_profile_edit')]
    public function Edit_profile(Request $req,EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileUserType::class,$user);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $imageFile = $form->get('image_name')->getData();
            if ($imageFile) {
                // Move uploaded file to desired location
                // Example:
                $uploadsDirectory = $this->getParameter('uploads_directory');
                $imageFileName = md5(uniqid()) . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $uploadsDirectory,
                    $imageFileName
                );
                // Set image file name to user entity
                $user->setImageName($imageFileName);
            }
            $em->persist($user);
            $em->flush();
            notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addSuccess('Vous avez modifié votre profile avec success');
            return $this->redirectToRoute('app_index');
        }
        else
        {
            notyf()
            ->position('x', 'center')
            ->position('y', 'top')
            ->addError('Erreur a la modification');
        }

        return $this->render('index/editprofile.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }

}