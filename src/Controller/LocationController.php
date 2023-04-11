<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Location;
use App\Form\CrudType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    #[Route('/index_front', name: 'index_front')]
    public function index(ManagerRegistry $doctrine): Response
{
    $entityManager = $doctrine->getManager();
    $repository = $entityManager->getRepository(Location::class);
    $elements = $repository->findAll();

    return $this->render('location/index_front.html.twig', [
        
        'List' => $elements,
    ]);
}
#[Route('accueil', name: 'accueil')]
    public function accueil(ManagerRegistry $doctrine): Response
{
    $entityManager = $doctrine->getManager();
    $repository = $entityManager->getRepository(Location::class);
    $elements = $repository->findAll();

    return $this->render('location/accueil.html.twig', [
        
        'List' => $elements,
    ]);
}
    
    #[Route('create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine)
    {
        $location= new Location();
        $form= $this->createForm(CrudType::class,$location);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $em =$doctrine->getManager();
            $em->persist($location);
            $em->flush();
            $this->addFlash('notice','submitted successfully');
            return $this->redirectToRoute('accueil');
        }
        return $this->render('location/create.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/location/update/{id}', name: 'update')]
public function update(Request $request, ManagerRegistry $doctrine, int $id): Response
{
    $entityManager = $doctrine->getManager();
    $location = $entityManager->getRepository(Location::class)->find($id);

    if (!$location) {
        throw $this->createNotFoundException('Location not found');
    }

    $form = $this->createForm(CrudType::class, $location);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('index_front');
    }

    return $this->render('location/update.html.twig', [
        'form' => $form->createView(),
    ]);
}
#[Route('/location/delete/{id}', name: 'delete')]
public function delete(Request $request, ManagerRegistry $doctrine, int $id): Response
{
    $entityManager = $doctrine->getManager();
    $location = $entityManager->getRepository(Location::class)->find($id);

    if (!$location) {
        throw $this->createNotFoundException('Location not found');
    }

    $entityManager->remove($location);
    $entityManager->flush();

    return $this->redirectToRoute('index_front');
}


}
