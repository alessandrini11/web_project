<?php

namespace App\Controller;

use App\Entity\Commmentaire;
use App\Entity\Competition;
use App\Entity\Resultat;
use App\Form\CommmentaireType;
use App\Form\CompetitionType;
use App\Form\ResultatType;
use App\Repository\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/competition")
 */
class CompetitionController extends AbstractController
{
    /**
     * @Route("/", name="competition_index", methods={"GET"})
     */
    public function index(CompetitionRepository $competitionRepository): Response
    {
        return $this->render('competition/index.html.twig', [
            'competitions' => $competitionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="competition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $competition = new Competition();
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($competition);
            $entityManager->flush();

            return $this->redirectToRoute('competition_index');
        }

        return $this->render('competition/new.html.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competition_show")
     *
     */
    public function show(Competition $competition, Request $request): Response
    {
        $resultat = new Resultat();
        $form = $this->createForm(ResultatType::class, $resultat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resultat->setCompetition($competition);

            $em = $this->getDoctrine()->getManager();
            $em->persist($resultat);
            $em->flush();

            $this->addFlash(
                'success',
                "le resultat a été bien affiché"
            );
        }
        return $this->render('competition/show.html.twig', [
            'competition' => $competition,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="competition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Competition $competition): Response
    {
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competition_index');
        }

        return $this->render('competition/edit.html.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Competition $competition): Response
    {
        if ($this->isCsrfTokenValid('delete' . $competition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($competition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('competition_index');
    }
}