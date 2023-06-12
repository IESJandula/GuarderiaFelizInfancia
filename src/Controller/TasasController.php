<?php

namespace App\Controller;

use App\Entity\Tasas;
use App\Form\TasasType;
use App\Repository\TasasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tasas')]
class TasasController extends AbstractController
{
    #[Route('/', name: 'app_tasas_index', methods: ['GET'])]
    public function index(TasasRepository $tasasRepository): Response
    {
        return $this->render('tasas/index.html.twig', [
            'tasas' => $tasasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tasas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TasasRepository $tasasRepository): Response
    {
        $tasa = new Tasas();
        $form = $this->createForm(TasasType::class, $tasa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tasasRepository->save($tasa, true);

            return $this->redirectToRoute('app_tasas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tasas/new.html.twig', [
            'tasa' => $tasa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tasas_show', methods: ['GET'])]
    public function show(Tasas $tasa): Response
    {
        return $this->render('tasas/show.html.twig', [
            'tasa' => $tasa,
            'alumnos'=> $tasa->getAlumno()
            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tasas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tasas $tasa, TasasRepository $tasasRepository): Response
    {
        $form = $this->createForm(TasasType::class, $tasa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tasasRepository->save($tasa, true);

            return $this->redirectToRoute('app_tasas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tasas/edit.html.twig', [
            'tasa' => $tasa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tasas_delete', methods: ['POST'])]
    public function delete(Request $request, Tasas $tasa, TasasRepository $tasasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tasa->getId(), $request->request->get('_token'))) {
            $tasasRepository->remove($tasa, true);
        }

        return $this->redirectToRoute('app_tasas_index', [], Response::HTTP_SEE_OTHER);
    }
}
