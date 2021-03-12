<?php

namespace App\Controller;

use App\Repository\AthleteRepository;
use App\Repository\CommmentaireRepository;
use App\Repository\CompetitionRepository;
use App\Repository\DisciplineRepository;
use App\Repository\EntraineurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @return Response
     * @Route("/",name="admin_index")
     */
    public function index(AthleteRepository $athleteRepository, CommmentaireRepository $commmentaireRepository,CompetitionRepository $competitionRepository,DisciplineRepository $disciplineRepository,EntraineurRepository $entraineurRepository) :Response
    {
        return $this->render('admin/index.html.twig', [
            'athletes' => $athleteRepository->findAll(),
            'commentaires' => $commmentaireRepository->findAll(),
            'competitions' => $competitionRepository->findAll(),
            'disciplines' => $disciplineRepository->findAll(),
            'entraineurs' => $entraineurRepository->findAll(),
        ]);
    }
}
