<?php

namespace App\Controller;

use App\Entity\Sexe;
use App\Form\SexeType;
use App\Repository\SexeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sexe")
 */
class SexeController extends AbstractController
{
    /**
     * @Route("/", name="sexe_index", methods={"GET"})
     */
    public function index(SexeRepository $sexeRepository): Response
    {
        return $this->render('sexe/index.html.twig', [
            'sexes' => $sexeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sexe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sexe = new Sexe();
        $form = $this->createForm(SexeType::class, $sexe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sexe);
            $entityManager->flush();

            return $this->redirectToRoute('sexe_index');
        }

        return $this->render('sexe/new.html.twig', [
            'sexe' => $sexe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sexe_show", methods={"GET"})
     */
    public function show(Sexe $sexe): Response
    {
        return $this->render('sexe/show.html.twig', [
            'sexe' => $sexe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sexe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sexe $sexe): Response
    {
        $form = $this->createForm(SexeType::class, $sexe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sexe_index');
        }

        return $this->render('sexe/edit.html.twig', [
            'sexe' => $sexe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sexe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sexe $sexe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sexe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sexe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sexe_index');
    }
}
