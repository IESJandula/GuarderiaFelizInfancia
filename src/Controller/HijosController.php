<?php

namespace App\Controller;

use App\Entity\Hijos;
use App\Entity\Notificacion;
use App\Form\HijosEditType;
use App\Form\HijosType;
use App\Repository\HijosRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/hijos')]
class HijosController extends AbstractController
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    #[Route('/index', name: 'app_hijos_index', methods: ['GET'])]
    public function index(HijosRepository $hijosRepository): Response
    {
        return $this->render('hijos/index.html.twig', [
            'hijos' => $hijosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hijos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HijosRepository $hijosRepository, UrlGeneratorInterface $urlGenerator): Response
{
    $hijo = new Hijos();
    $form = $this->createForm(HijosType::class, $hijo);
    
    $form->handleRequest($request);
    $hijo->setUser($this->security->getUser());
    
    if ($form->isSubmitted() && $form->isValid()) {
        $hijosRepository->save($hijo, true);
        
        // Obtener el ID del usuario actual a traves del propio hijo
        $userId = $hijo->getUser()->getId();
        
        // Generar la URL con el parámetro del ID del usuario
        $url = $urlGenerator->generate('app_user_show', ['id' => $userId]);
        
        // Redirigir a la URL generada
        return $this->redirect($url);
    }

    return $this->renderForm('hijos/new.html.twig', [
        'hijo' => $hijo,
        'form' => $form,
    ]);
}

    #[Route('/{id}', name: 'app_hijos_show', methods: ['GET'])]
    public function show(Hijos $hijo, ManagerRegistry $managerRegistry): Response
    {      
     //   $repo = $managerRegistry->getManager()->getRepository(Notificacion::class);
     //   //$notificaciones= $repo->findAll();
     //   $qb = $repo->createQueryBuilder('n')
     //           ->join('n.alumno', 'h')
     //           ->where('h.id = :hijoId')
     //           ->setParameter('hijoId', $hijo->getId())
     //           ->getQuery();

    // $notificaciones = $qb->getResult();


      

        // $notificaciones = $hijo->getNotificacion();
        return $this->render('hijos/show.html.twig', [
            'hijo' => $hijo,
            'tasas'=> $hijo->getTasas(),
            'notificaciones'=>$hijo->getNotificacion()
            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hijos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hijos $hijo, HijosRepository $hijosRepository, UrlGeneratorInterface $urlGenerator): Response
    {
        
        //$form = $this->createForm(HijosType::class, $hijo); este formulario genera todos los formmularios, pero habia uno que no necesitaba
        $form = $this->createForm(HijosEditType::class, $hijo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hijosRepository->save($hijo, true);

        // Obtener el ID del usuario actual a traves del propio hijo
        $userId = $hijo->getUser()->getId();
        
        // Generar la URL con el parámetro del ID del usuario
        $url = $urlGenerator->generate('app_user_show', ['id' => $userId]);
        
        // Redirigir a la URL generada
        return $this->redirect($url);
        }

        return $this->renderForm('hijos/edit.html.twig', [
            'hijo' => $hijo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hijos_delete', methods: ['POST'])]
    public function delete(Request $request, Hijos $hijo, HijosRepository $hijosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hijo->getId(), $request->request->get('_token'))) {
            $hijosRepository->remove($hijo, true);
        }

        return $this->redirectToRoute('app_hijos_index', [], Response::HTTP_SEE_OTHER);
    }
}
