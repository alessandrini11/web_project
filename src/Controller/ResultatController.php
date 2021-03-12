<?php

namespace App\Controller;

use App\Entity\Resultat;
use App\Form\ResultatType;
use App\Repository\ResultatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/resultat")
 */
class ResultatController extends AbstractController
{
    /**
     * @Route("/", name="resultat_index", methods={"GET"})
     */
    public function index(ResultatRepository $resultatRepository): Response
    {
        return $this->render('resultat/index.html.twig', [
            'resultats' => $resultatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="resultat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $resultat = new Resultat();
        $form = $this->createForm(ResultatType::class, $resultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resultat);
            $entityManager->flush();

            return $this->redirectToRoute('resultat_index');
        }

        return $this->render('resultat/new.html.twig', [
            'resultat' => $resultat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resultat_show", methods={"GET"})
     */
    public function show(Resultat $resultat): Response
    {
        return $this->render('resultat/show.html.twig', [
            'resultat' => $resultat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="resultat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Resultat $resultat): Response
    {
        $form = $this->createForm(ResultatType::class, $resultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resultat_index');
        }

        return $this->render('resultat/edit.html.twig', [
            'resultat' => $resultat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resultat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Resultat $resultat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resultat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resultat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('resultat_index');
    }
}
