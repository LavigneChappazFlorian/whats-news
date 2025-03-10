<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Form\ScheduleType;
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
}
