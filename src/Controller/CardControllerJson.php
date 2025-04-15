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

    #[Route("/api/deck/shuffle", name: "api_deck_shuffle", methods: ["POST"])]
    public function apiDeckShuffle(SessionInterface $session): JsonResponse
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
    
        $session->set("deck", $deck);
        $session->remove("drawn_cards");
    
        $cards = $deck->getCards();
        $unicodeCards = [];
    
        foreach ($cards as $card) {
            $unicodeCards[] = $card->getUnicode();
        }
    
        $response = new JsonResponse($unicodeCards);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
    
    #[Route("/api/deck/draw/{number<\d+>?1}", name: "api_deck_draw", methods: ["POST"])]
    public function apiDeckDraw(Request $request, int $number, SessionInterface $session): JsonResponse
    {
        $formNumber = $request->request->getInt('number', $number);
    
        $deck = $session->get("deck") ?? new DeckOfCards();
    
        $drawCount = min($formNumber, $deck->count());
        $drawn = $deck->draw($drawCount);
    
        $drawnCards = $session->get("drawn_cards", []);
        foreach ($drawn as $card) {
            $drawnCards[] = $card;
        }
    
        $session->set("deck", $deck);
        $session->set("drawn_cards", $drawnCards);
    
        $drawnUnicode = [];
        foreach ($drawn as $card) {
            $drawnUnicode[] = $card->getUnicode();
        }
    
        $drawnCardsUnicode = [];
        foreach ($drawnCards as $card) {
            $drawnCardsUnicode[] = $card->getUnicode();
        }
    
        $data = [
            'drawn' => $drawnUnicode,
            'drawnCards' => $drawnCardsUnicode,
            'cardsLeft' => $deck->count()
        ];
    
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
}
