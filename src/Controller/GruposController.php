<?php

namespace App\Controller;

use App\Entity\Grupos;
use App\Entity\Hijos;
use App\Form\GruposType;
use App\Repository\GruposRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/grupos')]
class GruposController extends AbstractController
{
    #[Route('/index', name: 'app_grupos_index', methods: ['GET'])]
    public function index(GruposRepository $gruposRepository): Response
    {
        return $this->render('grupos/index.html.twig', [
            'grupos' => $gruposRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_grupos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GruposRepository $gruposRepository): Response
    {
        $grupo = new Grupos();
        $form = $this->createForm(GruposType::class, $grupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gruposRepository->save($grupo, true);

            return $this->redirectToRoute('app_grupos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('grupos/new.html.twig', [
            'grupo' => $grupo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_grupos_show', methods: ['GET'])]
    public function show(Grupos $grupo): Response
    {
        $id = $grupo->getId();
        // $repo = $managerRegistry->getManager()->getRepository(Hijos::class);
        $hijos = $grupo->getAlumnos();
       
        return $this->render('grupos/show.html.twig', [
            'grupo' => $grupo,
            'alumnos'=>$hijos
        ]);
    }

    #[Route('/{id}/edit', name: 'app_grupos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Grupos $grupo, GruposRepository $gruposRepository): Response
    {
        $form = $this->createForm(GruposType::class, $grupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gruposRepository->save($grupo, true);

            return $this->redirectToRoute('app_grupos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('grupos/edit.html.twig', [
            'grupo' => $grupo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_grupos_delete', methods: ['POST'])]
    public function delete(Request $request, Grupos $grupo, GruposRepository $gruposRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grupo->getId(), $request->request->get('_token'))) {
            $gruposRepository->remove($grupo, true);
        }

        return $this->redirectToRoute('app_grupos_index', [], Response::HTTP_SEE_OTHER);
    }
}
