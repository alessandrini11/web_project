<?php

namespace App\Controller;

use App\Entity\Commmentaire;
use App\Form\CommmentaireType;
use App\Repository\CommmentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commmentaire")
 */
class CommmentaireController extends AbstractController
{
    /**
     * @Route("/", name="commmentaire_index", methods={"GET"})
     */
    public function index(CommmentaireRepository $commmentaireRepository): Response
    {
        return $this->render('commmentaire/index.html.twig', [
            'commmentaires' => $commmentaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commmentaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commmentaire = new Commmentaire();
        $form = $this->createForm(CommmentaireType::class, $commmentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commmentaire);
            $entityManager->flush();

            return $this->redirectToRoute('commmentaire_index');
        }

        return $this->render('commmentaire/new.html.twig', [
            'commmentaire' => $commmentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commmentaire_show", methods={"GET"})
     */
    public function show(Commmentaire $commmentaire): Response
    {
        return $this->render('commmentaire/show.html.twig', [
            'commmentaire' => $commmentaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commmentaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commmentaire $commmentaire): Response
    {
        $form = $this->createForm(CommmentaireType::class, $commmentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commmentaire_index');
        }

        return $this->render('commmentaire/edit.html.twig', [
            'commmentaire' => $commmentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commmentaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commmentaire $commmentaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commmentaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commmentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commmentaire_index');
    }
}
