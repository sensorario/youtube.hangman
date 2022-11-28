<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dictionary = [];
$dictionary[] = 'controller';
$dictionary[] = 'framework';
$dictionary[] = 'hangman';
$dictionary[] = 'model';
$dictionary[] = 'php';
$dictionary[] = 'view';

$hangman = new Hangman();
$hangman->setWord($dictionary[rand(0, count($dictionary) - 1)]);

function menu($hangman) {
    passthru("clear");
    printf("\n\nWord: '%s'.", $hangman->printDottedWord());
    printf("\nWrong attempts: '%s'.", $hangman->wrongAttempts());
}

function guess($hangman) {
    $letter = readline("\nGuess a letter: ");
    $hangman->guess($letter);
}

do {
    menu($hangman);
    guess($hangman);
} while($hangman->isWordRevealed() === false);

printf("\nYOU WIN!!");
