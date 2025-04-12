<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    #[Route("/lucky/number/twig", name: "lucky_number")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('lucky_number.html.twig', $data);
    }

    #[Route("/", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/api", name: "api")]
    public function api(): Response
    {
        return $this->render('api.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $number = random_int(1, 100);

        $moods = [
            'sporty' => [
                'image' => 'img/gifs/sporty.gif',
                'color' => '#ff00ff'
            ],
            'sleepy' => [
                'image' => 'img/gifs/sleepy.gif',
                'color' => '#88ccff'
            ],
            'happy' => [
                'image' => 'img/gifs/happy.gif',
                'color' => '#ff4444'
            ],
            'in love' => [
                'image' => 'img/gifs/inlove.gif',
                'color' => '#cc99ff'
            ]
        ];

        $moodKey = array_rand($moods);
        $mood = $moods[$moodKey];

        return $this->render('lucky.html.twig', [
            'number' => $number,
            'moodName' => $moodKey,
            'moodImage' => $mood['image'],
            'moodColor' => $mood['color']
        ]);
    }

    #[Route("/session", name: "session")]
    public function session(SessionInterface $session): Response
    {
        {
            $sessionData = $session->all();

            return $this->render('session.html.twig', [
                'session' => $sessionData
            ]);
        }
    }

    #[Route("/session/delete", name: "session_delete")]
    public function sessionDelete(SessionInterface $session): Response
    {
        $this->addFlash(
            'notice',
            'Your session has been deleted!'
        );

        $session->clear();
        return $this->redirectToRoute('session');
    }
}
