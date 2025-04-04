<?php

namespace App\Controller;

/*
use App\Dice\Dice;
use App\Dice\DiceGraphic;
use App\Dice\DiceHand;
*/

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
        return $this->render('card/card_deck.html.twig');
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
