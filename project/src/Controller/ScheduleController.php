<?php

namespace App\Controller;

use App\Entity\Schedule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ScheduleController extends AbstractController
{
    #[Route('/', name: 'app_schedule')]
    public function show(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Schedule::class);
        $schedules = $repository->findAll();

        return $this->render('schedule/index.html.twig', [
            'controller_name' => 'ScheduleController',
            'schedules' => $schedules
        ]);
    }
}
