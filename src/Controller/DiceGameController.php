<?php

namespace App\Controller;

use App\Dice\Dice;
use App\Dice\DiceGraphic;
use App\Dice\DiceHand;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiceGameController extends AbstractController
{
    #[Route("/game/pig", name: "pig_start")]
    public function home(): Response
    {
        return $this->render('pig/home.html.twig');
    }

    #[Route("/game/pig/test/roll", name: "test_roll_dice")]
    public function testRollDice(): Response
    {
        //$die = new Dice();
        $die = new DiceGraphic();

        $data = [
            "dice" => $die->roll(),
            "diceString" => $die->getAsString(),
        ];

        return $this->render('pig/test/roll.html.twig', $data);
    }

    #[Route("/game/pig/test/roll/{num<\d+>}", name: "test_roll_num_dices")]
    public function testRollDices(int $num): Response
    {
        if ($num > 99) {
            throw new \Exception("Can not roll more than 99 dices!");
        }

        $diceRoll = [];
        for ($i = 1; $i <= $num; $i++) {
            //$die = new Dice();
            $die = new DiceGraphic();
            $die->roll();
            $diceRoll[] = $die->getAsString();
        }

        $data = [
            "num_dices" => count($diceRoll),
            "diceRoll" => $diceRoll,
        ];

        return $this->render('pig/test/roll_many.html.twig', $data);
    }

    #[Route("/game/pig/test/dicehand/{num<\d+>}", name: "test_dicehand")]
    public function testDiceHand(int $num): Response
    {
        if ($num > 99) {
            throw new \Exception("Can not roll more than 99 dices!");
        }

        $hand = new DiceHand();
        for ($i = 1; $i <= $num; $i++) {
            if ($i % 2 === 1) {
                $hand->add(new DiceGraphic());
            } else {
                $hand->add(new Dice());
            }
        }

        $hand->roll();

        $data = [
            "num_dices" => $hand->getNumberDices(),
            "diceRoll" => $hand->getString(),
        ];

        return $this->render('pig/test/dicehand.html.twig', $data);
    }

    // PIG INIT GET AND POST
    #[Route("/game/pig/init", name: "pig_init_get", methods: ['GET'])]
    public function init(): Response
    {
        return $this->render('pig/init.html.twig');
    }

    #[Route("/game/pig/init", name: "pig_init_post", methods: ['POST'])]
    public function initCallback(): Response
    {
        // Deal with the submitted form

        return $this->redirectToRoute('pig_play');
    }

    #[Route("/game/pig/play", name: "pig_play", methods: ['GET'])]
    public function play(): Response
    {
        // Logic to play the game

        return $this->render('pig/play.html.twig');
    }

    #[Route("/game/pig/roll", name: "pig_roll", methods: ['POST'])]
    public function roll(): Response
    {
        // Logic to roll the dice

        return $this->render('pig/play.html.twig');
    }

    #[Route("/game/pig/save", name: "pig_save", methods: ['POST'])]
    public function save(): Response
    {
        // Logic to save the round

        return $this->render('pig/play.html.twig');
    }
}
