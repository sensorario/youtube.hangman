<?php

use PHPUnit\Framework\TestCase;

class HangmanTest extends TestCase
{
    private Hangman $hangman;

    public function setUp(): void
    {
        $this->hangman = new Hangman();
    }

    /** @test */
    public function shouldTransformWordInDottedLines()
    {
        $this->hangman->setWord('hangman');
        $this->assertEquals('-------', $this->hangman->printDottedWord());
    }

    /** @test */
    public function shouldReplaceDashesWithRightGuess()
    {
        $this->hangman->setWord('hangman');
        $this->hangman->guess('a');
        $this->assertEquals('-a---a-', $this->hangman->printDottedWord());
    }

    /** @test */
    public function shouldCountMissingLetters()
    {
        $this->hangman->setWord('hangman');
        $this->assertEquals(7, $this->hangman->missingLetters());
        $this->hangman->guess('a');
        $this->assertEquals(5, $this->hangman->missingLetters());
    }

    /** @test */
    public function shouldCountWrongGuesses()
    {
        $this->hangman->setWord('hangman');
        $this->assertEquals(0, $this->hangman->wrongGuesses());
        $this->hangman->guess('x');
        $this->assertEquals(1, $this->hangman->wrongGuesses());
    }

    /** @test */
    public function shouldDetectWheneverWordIsRevealed()
    {
        $this->hangman->setWord('hangman');
        $this->hangman->guess('h');
        $this->hangman->guess('a');
        $this->hangman->guess('n');
        $this->hangman->guess('g');
        $this->asswerSame(false, $this->hangman->isWordRevealed());

        $this->hangman->guess('m');
        $this->asswerSame(true, $this->hangman->isWordRevealed());
    }

    /** @test */
    public function shouldDetectWheneverWordIsRevealed()
    {
        $this->hangman->setWord('hangman');
        $this->asswerSame('', $this->hangman->wrongAttempts());

        $this->hangman->guess('x');
        $this->hangman->guess('p');
        $this->asswerSame('x,p', $this->hangman->wrongAttempts());
    }

    /** @test */
    public function shouldAllowInfiniteNumberOfWrongAttemptsByDefault()
    {
        $this->hangman->setWord('hangman');
        $this->asswerSame('infinite', $this->hangman->wrongAttemptsRemaining());

        $this->hangman->guess('x');
        $this->asswerSame('infinite', $this->hangman->wrongAttemptsRemaining());
    }

    /** @test */
    public function shouldSpecifyNumberOfWrongAttempts()
    {
        $this->hangman->setWord('hangman');
        $this->hangman->setNumberOfWrongAttempts(42);
        $this->asswerSame(42, $this->hangman->wrongAttemptsRemaining());

        $this->hangman->guess('x');
        $this->asswerSame(41, $this->hangman->wrongAttemptsRemaining());
    }
}
