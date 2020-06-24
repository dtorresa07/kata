<?php


namespace App;


class TenisMatch
{
    protected Player $playerOne;
    protected Player $playerTwo;

    public function __construct(Player $playerOne, Player $playerTwo)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
    }

    public function score(){

        if ($this->hasWinner()){
            return "Winner: " . $this->leader()->name;
        };

        if ($this->hasAdvantage()){
            return "Advantage: " . $this->leader()->name;
        }


        if ($this->inDeuce()){

            return "deuce";
        }

        return sprintf(
            "%s-%s",
            $this->playerOne->toTerm(),
            $this->playerTwo->toTerm(),
        );
    }


    protected function hasWinner(){

        if (max([$this->playerOne->points, $this->playerTwo->points]) < 4){
            return false;
        }

        return abs($this->playerOne->points - $this->playerTwo->points) >= 2;

    }

    /**
     * @return string
     */
    public function leader(): Player
    {
        return $this->playerOne->points > $this->playerTwo->points
            ? $this->playerOne
            : $this->playerTwo;
    }

    /**
     * @return bool
     */
    public function inDeuce(): bool
    {
        return $this->canBeWon() && $this->playerOne->points === $this->playerTwo->points;
    }

    /**
     * @return bool
     */
    protected function hasAdvantage(): bool
    {

        if ($this->canBeWon()) {
            return ! $this->inDeuce();
        }

        return false;


    }

    /**
     * @return bool
     */
    protected function canBeWon(): bool
    {
        return $this->playerOne->points >= 3 && $this->playerTwo->points >= 3;
    }
}