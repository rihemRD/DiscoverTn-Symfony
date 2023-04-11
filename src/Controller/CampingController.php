<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Form\CampingType;
use App\Repository\CampingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/camping')]
class CampingController extends AbstractController
{
    #[Route('/', name: 'app_camping_index', methods: ['GET'])]
    public function index(CampingRepository $campingRepository): Response
    {
        return $this->render('camping/index.html.twig', [
            'campings' => $campingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_camping_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CampingRepository $campingRepository): Response
    {
        $camping = new Camping();
        $form = $this->createForm(CampingType::class, $camping);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $startDate = $form->get('dateDebut')->getData();
        $endDate = $form->get('dateFin')->getData();
        
        if ($endDate < $startDate) {
            $this->addFlash('error', 'La date de fin ne peut pas être avant la date de début.');
            return $this->redirectToRoute('app_camping_new');
        }

            $file = $form->get('imagec')->getData();
        $fileName = uniqid().'.'.$file->guessExtension();
        $file->move($this->getParameter('images_directory'), $fileName);

        $camping->setImagec($fileName);
            $campingRepository->save($camping, true);

            return $this->redirectToRoute('app_camping_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('camping/new.html.twig', [
            'camping' => $camping,
            'form' => $form,
        ]);
    }

    #[Route('/{idCamping}', name: 'app_camping_show', methods: ['GET'])]
    public function show(Camping $camping): Response
    {
        return $this->render('camping/show.html.twig', [
            'camping' => $camping,
        ]);
    }

    #[Route('/{idCamping}/edit', name: 'app_camping_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Camping $camping, CampingRepository $campingRepository): Response
    {
        $form = $this->createForm(CampingType::class, $camping);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campingRepository->save($camping, true);

            return $this->redirectToRoute('app_camping_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('camping/edit.html.twig', [
            'camping' => $camping,
            'form' => $form,
        ]);
    }

    #[Route('/{idCamping}', name: 'app_camping_delete', methods: ['POST'])]
    public function delete(Request $request, Camping $camping, CampingRepository $campingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$camping->getIdCamping(), $request->request->get('_token'))) {
            $campingRepository->remove($camping, true);
        }

        return $this->redirectToRoute('app_camping_index', [], Response::HTTP_SEE_OTHER);
    }
}
