<?php

class HangmanTest
{
    private string $word;
    private string $solution;
    private int $missingLetters;
    private array $wrongAttempts;
    private $attempts = -1;

    public function setWord(
        string $word,
    ) {
        $this->word = $word;
        $this->solution = str_pad('', strlen($word), '-');
        $this->missingLetters = strlen($word);
    }

    public function printDottedWord(): string
    {
        return $this->solution;
    }

    public function guess(string $letter)
    {
        $founded = false;
        for ($i=0; $i<strlen($this->word); $i++) {
            if ($this->word[$i] == $letter) {
                $this->solution[$i] = $letter;
                $this->missingLetters--;
                $founded = true;
            }
        }

        if ($founded === false) {
            $this->wrongAttempts[] = $letter;
        }
    }

    public function missingLetters(): int
    {
        return $this->missingLetters;
    }

    public function wrongGuesses(): int
    {
        return count($this->wrongAttempts);
    }

    public function isWordRevealed(): bool
    {
        return $this->solution === $this->word;
    }

    public function wrongAttempts(): string
    {
        return join(',', $this->wrongAttempts);
    }

    public function wrongAttemptsRemaining(): string|int
    {
        if ($this->attempts === -1) {
            return 'infinite';
        }

        return $this->attempts - count($this->wrongAttempts);
    }

    public function setNumberOfWrongAttempts(int $attempts): void
    {
        $this->attempts = $attempts;
    }
}
