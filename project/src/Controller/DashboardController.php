<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Form\ScheduleType;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[IsGranted("ROLE_ADMIN")]
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Schedule::class);
        $schedules = $repository->findAll();

        return $this->render('dashboard/index.html.twig', [
            'schedules' => $schedules,
        ]);
    }

    #[Route('/dashboard/create', name: 'app_dashboard_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $schedule = new Schedule();
        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($schedule);
            $em->flush();
            $this->addFlash('success', 'Emploi du temps créé !');

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('schedule/create.html.twig', [
            'controller_name' => 'DashboardController',
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/{id}/edit', name: 'app_dashboard_edit', requirements: ['id' => '\d+'])]
    public function edit(ScheduleRepository $scheduleRepository, Request $request, EntityManagerInterface $em, int $id): Response
    {
        $schedule = $scheduleRepository->find($id);

        $form = $this->createForm(ScheduleType::class, $schedule); // création d'un formulaire avec la récupération du formulaire "type"

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($schedule); // prépare/mets en attente les données avant de les insérer ou update dans la bdd
            $em->flush(); // éxécute réellement les requêtes SQL en attente

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('schedule/edit.html.twig', [
            'schedule' => $schedule,
            'form' => $form->createView(),
        ]);
    }
}
