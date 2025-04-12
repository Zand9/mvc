<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerJson extends AbstractController
{
    #[Route("/api/deck", name: "api_deck")]
    public function jsonDeck(SessionInterface $session): Response
    {
        $deck = $session->get("deck");

        if (!$deck) {
            $deck = new DeckOfCards();
        }

        $deck->sort();

        $session->set("deck", $deck);

        $data = array_map(fn ($card) => $card->getUnicode(), $deck->getCards());

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_deck_shuffle", methods: ["GET", "POST"])]
    public function apiDeckShuffle(SessionInterface $session): JsonResponse
    {
        $deck = new DeckOfCards();
        $deck->shuffle();

        $session->set("deck", $deck);
        $session->remove("drawn_cards");

        $cards = $deck->getCards();
        $data = array_map(fn ($card) => $card->getUnicode(), $cards);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/deck/draw/{number<\d+>?1}", name: "api_deck_draw", methods: ["GET", "POST"])]
    public function apiDeckDraw(int $number, SessionInterface $session): JsonResponse
    {
        $deck = $session->get("deck") ?? new DeckOfCards();

        $drawCount = min($number, $deck->count());
        $drawn = $deck->draw($drawCount);

        $drawnCards = $session->get("drawn_cards", []);
        foreach ($drawn as $card) {
            $drawnCards[] = $card;
        }

        $session->set("deck", $deck);
        $session->set("drawn_cards", $drawnCards);

        $data = [
            'drawn' => array_map(fn ($card) => $card->getUnicode(), $drawn),
            'drawnCards' => array_map(fn ($card) => $card->getUnicode(), $drawnCards),
            'cardsLeft' => $deck->count()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
}
