<?php

namespace App\BeautyStackOverflow;

use DateTimeImmutable;

class Answer
{
    /** @var Id */
    private $id;

    /** @var Id */
    private $questionId;

    /** @var Id */
    private $userId;

    /** @var string */
    private $text;

    /** @var DateTimeImmutable */
    private $createdAt;

    /** @var DateTimeImmutable */
    private $updatedAt;

    /** @var DateTimeImmutable */
    private $deletedAt;

    /**
     * Question constructor.
     *
     * @param Id                $id
     * @param Id                $questionId
     * @param Id                $userId
     * @param string            $text
     * @param DateTimeImmutable $createdAt
     * @param DateTimeImmutable $updatedAt
     * @param DateTimeImmutable $deletedAt
     */
    private function __construct(
        Id $id,
        Id $questionId,
        Id $userId,
        string $text,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        DateTimeImmutable $deletedAt
    )
    {
        $this->id               = $id;
        $this->questionId       = $questionId;
        $this->userId           = $userId;
        $this->text             = $text;
        $this->createdAt        = $createdAt;
        $this->updatedAt        = $updatedAt;
        $this->deletedAt        = $deletedAt;
    }

    public static function buildFromValues(
        Id $id,
        Id $questionId,
        Id $userId,
        string $text,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        DateTimeImmutable $deletedAt
    )
    {
        return new self($id, $questionId, $userId, $text, $createdAt, $updatedAt, $deletedAt);
    }

//    public static function buildFromEntity()
//    {
//
//    }

    /**
     * @return Id
     */
    public function id(): Id
    {
        return $this->id;
    }

    /**
     * @return Id
     */
    public function questionId(): Id
    {
        return $this->questionId;
    }

    /**
     * @return Id
     */
    public function userId(): Id
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return DateTimeImmutable
     */
    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function deletedAt(): DateTimeImmutable
    {
        return $this->deletedAt;
    }
}