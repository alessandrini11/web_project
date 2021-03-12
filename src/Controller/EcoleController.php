<?php

namespace App\Controller;

use App\Entity\Ecole;
use App\Form\EcoleType;
use App\Repository\EcoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ecole")
 */
class EcoleController extends AbstractController
{
    /**
     * @Route("/", name="ecole_index", methods={"GET"})
     */
    public function index(EcoleRepository $ecoleRepository): Response
    {
        return $this->render('ecole/index.html.twig', [
            'ecoles' => $ecoleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ecole_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ecole = new Ecole();
        $form = $this->createForm(EcoleType::class, $ecole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ecole);
            $entityManager->flush();

            return $this->redirectToRoute('ecole_index');
        }

        return $this->render('ecole/new.html.twig', [
            'ecole' => $ecole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ecole_show", methods={"GET"})
     */
    public function show(Ecole $ecole): Response
    {
        return $this->render('ecole/show.html.twig', [
            'ecole' => $ecole,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ecole_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ecole $ecole): Response
    {
        $form = $this->createForm(EcoleType::class, $ecole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ecole_index');
        }

        return $this->render('ecole/edit.html.twig', [
            'ecole' => $ecole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ecole_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ecole $ecole): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ecole->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ecole);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ecole_index');
    }
}
