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

        $news_rss = simplexml_load_file('https://www.amiens.fr/flux-rss/actus');
        $news_result = $news_rss->xpath('channel/item');

        $fun_fact_rss = simplexml_load_file('https://www.francetvinfo.fr/politique.rss');
        $fun_fact_result = $fun_fact_rss->xpath('channel/item');

        return $this->render('schedule/index.html.twig', [
            'schedules' => $schedules,
            'news_result' => $news_result,
            'fun_fact_result' => $fun_fact_result
        ]);
    }
}
