<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;


class Review
{
    #[Assert\NotBlank]
    protected array $meal;

    #[Assert\NotBlank]
    protected string $comment;

    /**
     * @return array
     */
    public function getMeal(): array
    {
        return $this->meal;
    }

    /**
     * @param array $meal
     */
    public function setMeal(array $meal): void
    {
        $this->meal = $meal;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}