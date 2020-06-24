<?php


namespace App;


/**
 * Class Game
 * @package App
 */
class Game{

    /**
     *  The number of frames in a game
     */
    const FRAMES_PER_GAME = 10;


    /**
     * All rolls for the game
     *
     * @var array
     */
    protected array $rolls = [];

    /**
     * Roll the ball
     *
     * @param int $pins
     * @return void
     */
    public function roll(int $pins)
    {
        $this->rolls[] = $pins;
    }

    /**
     * Calculate the final score
     *
     * @return int
     */
    public function score()
    {

        $score = 0;
        $roll = 0;

        foreach (range(1, self::FRAMES_PER_GAME) as $frame)
        {

            if($this->isStrike($roll)){
                $score += $this->pinCount($roll);

                $score += $this->strikeBonus($roll);


                $roll += 1;

                continue;
            }

            $score += $this->defaulFrameScore($roll);

            if ($this->isSpare($roll)){
                //you got a spare
                $score += $this->spareBonus($roll);

            }

            $roll += 2;



        }

        return $score;

    }

    /**
     * @param int $roll
     * @return bool
     */
    public function isStrike(int $roll): bool
    {
        return $this->pinCount($roll) === 10;
    }

    /**
     * @param int $roll
     * @return bool
     */
    public function isSpare(int $roll): bool
    {
        return $this->defaulFrameScore($roll) === 10;
    }

    /**
     * @param int $roll
     * @return mixed
     */
    public function defaulFrameScore(int $roll): int
    {
        return $this->pinCount($roll) + $this->pinCount($roll + 1);
    }

    /**
     * @param int $roll
     * @return int
     */
    protected function strikeBonus(int $roll): int
    {
        return $this->pinCount($roll + 1) + $this->pinCount($roll + 2);

    }


    /**
     * @param int $roll
     * @return int
     */
    protected function spareBonus(int $roll): int
    {

        return $this->pinCount($roll + 2);

    }

    protected function pinCount(int $roll): int
    {
        return $this->rolls[$roll];
    }
}