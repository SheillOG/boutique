<?php

namespace App\Controller;

use App\Entity\Panel;
use App\Form\PanelType;
use App\Repository\PanelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panel")
 */
class PanelController extends AbstractController
{
    /**
     * @Route("/", name="panel_index", methods={"GET"})
     */
    public function index(PanelRepository $panelRepository): Response
    {
        return $this->render('panel/index.html.twig', [
//            'panels' => $panelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="panel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $panel = new Panel();
        $form = $this->createForm(PanelType::class, $panel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panel);
            $entityManager->flush();

            return $this->redirectToRoute('panel_index');
        }

        return $this->render('panel/new.html.twig', [
            'panel' => $panel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panel_show", methods={"GET"})
     */
    public function show(Panel $panel): Response
    {
        return $this->render('panel/show.html.twig', [
            'panel' => $panel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="panel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Panel $panel): Response
    {
        $form = $this->createForm(PanelType::class, $panel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panel_index');
        }

        return $this->render('panel/edit.html.twig', [
            'panel' => $panel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Panel $panel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($panel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('panel_index');
    }
}
