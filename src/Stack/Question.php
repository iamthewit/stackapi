<?php

namespace App\Stack;

use DateTimeImmutable;

class Question
{
    /** @var Id */
    private $id;

    /** @var Id */
    private $groupId;

    /** @var Id */
    private $userId;

    /** @var string */
    private $text;

    /** @var Id|null */
    private $selectedAnswerId;

    /** @var DateTimeImmutable */
    private $createdAt;

    /** @var DateTimeImmutable */
    private $updatedAt;

    /** @var DateTimeImmutable|null */
    private $deletedAt;

    /**
     * Question constructor.
     *
     * @param Id                     $id
     * @param Id                     $groupId
     * @param Id                     $userId
     * @param string                 $text
     * @param Id|null                $selectedAnswerId
     * @param DateTimeImmutable      $createdAt
     * @param DateTimeImmutable      $updatedAt
     * @param DateTimeImmutable|null $deletedAt
     */
    private function __construct(
        Id $id,
        Id $groupId,
        Id $userId,
        string $text,
        ?Id $selectedAnswerId,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $deletedAt
    ) {
        $this->id               = $id;
        $this->groupId          = $groupId;
        $this->userId           = $userId;
        $this->text             = $text;
        $this->selectedAnswerId = $selectedAnswerId;
        $this->createdAt        = $createdAt;
        $this->updatedAt        = $updatedAt;
        $this->deletedAt        = $deletedAt;
    }

    public static function buildFromValues(
        Id $id,
        Id $groupId,
        Id $userId,
        string $text,
        ?Id $selectedAnswerId,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $deletedAt
    ) {
        return new self($id, $groupId, $userId, $text, $selectedAnswerId, $createdAt, $updatedAt, $deletedAt);
    }

    public static function buildFrom()
    {
        
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
    public function groupId(): Id
    {
        return $this->groupId;
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
     * @return Id|null
     */
    public function selectedAnswerId(): ?Id
    {
        return $this->selectedAnswerId;
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
     * @return DateTimeImmutable|null
     */
    public function deletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

}