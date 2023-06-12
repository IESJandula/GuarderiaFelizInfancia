<?php

namespace App\Controller;

use App\Entity\Notificacion;
use App\Form\NotificacionType;
use App\Repository\NotificacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/notificacion')]
class NotificacionController extends AbstractController
{
    #[Route('/', name: 'app_notificacion_index', methods: ['GET'])]
    public function index(NotificacionRepository $notificacionRepository): Response
    {
        return $this->render('notificacion/index.html.twig', [
            'notificacions' => $notificacionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_notificacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NotificacionRepository $notificacionRepository): Response
    {
        $notificacion = new Notificacion();
        $form = $this->createForm(NotificacionType::class, $notificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notificacionRepository->save($notificacion, true);

            return $this->redirectToRoute('app_notificacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('notificacion/new.html.twig', [
            'notificacion' => $notificacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_notificacion_show', methods: ['GET'])]
    public function show(Notificacion $notificacion): Response
    {

        return $this->render('notificacion/show.html.twig', [
            'notificacion' => $notificacion,
            'hijos'=> $notificacion->getHijos()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_notificacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Notificacion $notificacion, NotificacionRepository $notificacionRepository): Response
    {
        $form = $this->createForm(NotificacionType::class, $notificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notificacionRepository->save($notificacion, true);

            return $this->redirectToRoute('app_notificacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('notificacion/edit.html.twig', [
            'notificacion' => $notificacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_notificacion_delete', methods: ['POST'])]
    public function delete(Request $request, Notificacion $notificacion, NotificacionRepository $notificacionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notificacion->getId(), $request->request->get('_token'))) {
            $notificacionRepository->remove($notificacion, true);
        }

        return $this->redirectToRoute('app_notificacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
