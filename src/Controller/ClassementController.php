<?php

namespace App\Controller;

use App\Entity\Classement;
use App\Form\ClassementType;
use App\Repository\ClassementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/classement")
 */
class ClassementController extends AbstractController
{
    /**
     * @Route("/", name="classement_index", methods={"GET"})
     */
    public function index(ClassementRepository $classementRepository): Response
    {
        return $this->render('classement/index.html.twig', [
            'classements' => $classementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="classement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classement = new Classement();
        $form = $this->createForm(ClassementType::class, $classement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classement);
            $entityManager->flush();

            return $this->redirectToRoute('classement_index');
        }

        return $this->render('classement/new.html.twig', [
            'classement' => $classement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="classement_show", methods={"GET"})
     */
    public function show(Classement $classement): Response
    {
        return $this->render('classement/show.html.twig', [
            'classement' => $classement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="classement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classement $classement): Response
    {
        $form = $this->createForm(ClassementType::class, $classement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('classement_index');
        }

        return $this->render('classement/edit.html.twig', [
            'classement' => $classement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="classement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Classement $classement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('classement_index');
    }
}
