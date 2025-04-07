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
    public function cardDeckShuffle(): Response
    {
        return $this->render('card/card_deck_shuffle.html.twig');
    }

    #[Route("/card/deck/draw", name: "card_deck_draw")]
    public function cardDeckDraw(): Response
    {
        return $this->render('card/card_deck_draw.html.twig');
    }
}
