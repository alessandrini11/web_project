<?php

namespace App\Controller;

use App\Entity\Entraineur;
use App\Form\EntraineurType;
use App\Repository\EntraineurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/entraineur")
 */
class EntraineurController extends AbstractController
{
    /**
     * @Route("/", name="entraineur_index", methods={"GET"})
     */
    public function index(EntraineurRepository $entraineurRepository): Response
    {
        return $this->render('entraineur/index.html.twig', [
            'entraineurs' => $entraineurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="entraineur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entraineur = new Entraineur();
        $form = $this->createForm(EntraineurType::class, $entraineur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entraineur);
            $entityManager->flush();

            return $this->redirectToRoute('entraineur_index');
        }

        return $this->render('entraineur/new.html.twig', [
            'entraineur' => $entraineur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entraineur_show", methods={"GET"})
     */
    public function show(Entraineur $entraineur): Response
    {
        return $this->render('entraineur/show.html.twig', [
            'entraineur' => $entraineur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entraineur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entraineur $entraineur): Response
    {
        $form = $this->createForm(EntraineurType::class, $entraineur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entraineur_index');
        }

        return $this->render('entraineur/edit.html.twig', [
            'entraineur' => $entraineur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entraineur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entraineur $entraineur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entraineur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entraineur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entraineur_index');
    }
}
