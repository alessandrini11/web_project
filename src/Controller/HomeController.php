<?php

namespace App\Controller;

use App\Entity\Athlete;
use App\Entity\Commmentaire;
use App\Entity\Competition;
use App\Entity\Discipline;
use App\Form\AthleteType;
use App\Form\CommmentaireType;
use App\Repository\AthleteRepository;
use App\Repository\CommmentaireRepository;
use App\Repository\CompetitionRepository;
use App\Repository\DisciplineRepository;
use App\Repository\EntraineurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @Route("/", name="home")
     */
    public function index(CompetitionRepository $competitionRepository):Response
    {
        $competitions = $competitionRepository->findLatest();
        return $this->render('home/index.html.twig', [
            'competitions' => $competitions,
        ]);
    }

    /**
     * @return Response
     * @Route("disciplineshow/{id}",name="discipline_showP")
     */
    public function disciplineshow(Discipline $discipline):Response{
        return $this->render('home/disciplinelisteshow.html.twig',[
            'discipline' => $discipline
        ]);
    }
    /**
     * @return Response
     * @Route("/disciplineliste",name="discpline_public")
     */
    public function discipline(DisciplineRepository $repository):Response{
        return $this->render('home/disciplineliste.html.twig',[
            'disciplines' => $repository->findAll()
        ]);
    }
    /**
     * @return Response
     * @Route("/entraineurliste",name="entraineur_publique")
     */
    public function Entraineur(EntraineurRepository $repository):Response{
        return $this->render('home/entraineurliste.html.twig',[
            'entraineurs' => $repository->findAll()
        ]);
    }

    /**
     * @return Response
     * @Route("/athleteshow/{id}",name="athlete_public")
     */
    public  function  showPublicAthlete(Athlete $athlete):Response{
        return $this->render('home/athlete.html.twig',[
            'athlete' => $athlete
        ]);
    }
    /**
     * @Route("/competitionshow/{id}",name="show_public")
     */
    public function showpublic(Competition $competition, Request $request):Response{
        $commentaire = new Commmentaire();
        $form = $this->createForm(CommmentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setCompeition($competition);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "le commentaire a été bien posté"
            );
        }
        return $this->render('home/competitionshow.html.twig',[
            'competition' => $competition,
            'form' => $form->createView()
        ]);
    }

    /**
     * @return Response
     * @Route("/athletelist",name="athlete_liste")
     */
    public function athletes(AthleteRepository $repository):Response{
        $athletes = $repository->findAll();
        return $this->render('home/athleteliste.html.twig',[
            'athletes' => $athletes
        ]);
    }
    /**
     * @Route("/competitionpublique",name="liste")
     * @return Response
     */
    public function competitionList(EntityManagerInterface $manager):Response{
        $judo = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Judo'
                "
        )->getResult();
        $basketball = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Basketball'
                "
        )->getResult();
        $athletisme = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Athletisme'
                "
        )->getResult();
        $handball = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Handball'
                "
        )->getResult();
        $volleyball = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Volleyball'
                "
        )->getResult();
        $lutte = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Lutte'
                "
        )->getResult();
        $ttennis = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Table Tennis'
                "
        )->getResult();
        $ltennis = $manager->createQuery(
            "SELECT c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Lawn Tennis'
                "
        )->getResult();
        $football = $manager->createQuery(
            "SELECT d.sport,c.id, c.titre, c.date_debut, c.date_fin, c.date_publication, c.lieu, c.description
                FROM App\Entity\Competition c
                JOIN c.discipline d
                WHERE d.sport = 'Football'
                "
        )->getResult();

        return $this->render('home/competition.html.twig',[
            'athletismes' => $athletisme,
            'basketballs' => $basketball,
            'footballs' => $football,
            'handballs' => $handball,
            'judos' => $judo,
            'ltennis' => $ltennis,
            'luttes' => $lutte,
            'ttennis' => $ttennis,
            'volleyballs' => $volleyball
        ]);

    }
}
