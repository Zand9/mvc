<?php

namespace App\Controller;

use App\Card\DeckOfCards;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(): Response
    {
        return $this->render('/card/card.html.twig');
    }

    #[Route("/card/deck", name: "card_deck")]
    public function cardDeck(): Response
    {
        $deck = new DeckOfCards();
        $cards = $deck->getCards();

        return $this->render('card/card_deck.html.twig', [
            'cards' => $cards
        ]);
    }

    #[Route("/card/deck/shuffle", name: "card_deck_shuffle")]
    public function cardDeckShuffle(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        $deck->shuffle();

        $session->set("deck", $deck);
        $session->remove("drawn_cards");

        $cards = $deck->getCards();

        return $this->render('card/card_deck_shuffle.html.twig', [
            'cards' => $cards
        ]);
    }


    #[Route("/card/deck/draw/{number<\d+>?1}", name: "card_deck_draw")]
    public function cardDeckDraw(int $number, SessionInterface $session): Response
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

        return $this->render('card/card_deck_draw.html.twig', [
            'drawn' => $drawn,
            'drawnCards' => $drawnCards,
            'cardsLeft' => $deck->count()
        ]);
    }
}
