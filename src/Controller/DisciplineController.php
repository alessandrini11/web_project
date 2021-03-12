<?php

namespace App\Controller;

use App\Entity\Discipline;
use App\Form\DisciplineType;
use App\Repository\DisciplineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/discipline")
 */
class DisciplineController extends AbstractController
{
    /**
     * @Route("/", name="discipline_index", methods={"GET"})
     */
    public function index(DisciplineRepository $disciplineRepository): Response
    {
        return $this->render('discipline/index.html.twig', [
            'disciplines' => $disciplineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="discipline_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $discipline = new Discipline();
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($discipline);
            $entityManager->flush();

            return $this->redirectToRoute('discipline_index');
        }

        return $this->render('discipline/new.html.twig', [
            'discipline' => $discipline,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="discipline_show", methods={"GET"})
     */
    public function show(Discipline $discipline): Response
    {
        return $this->render('discipline/show.html.twig', [
            'discipline' => $discipline,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="discipline_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Discipline $discipline): Response
    {
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('discipline_index');
        }

        return $this->render('discipline/edit.html.twig', [
            'discipline' => $discipline,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="discipline_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Discipline $discipline): Response
    {
        if ($this->isCsrfTokenValid('delete'.$discipline->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($discipline);
            $entityManager->flush();
        }

        return $this->redirectToRoute('discipline_index');
    }
}
