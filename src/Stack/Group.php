<?php

namespace App\Stack;

use DateTimeImmutable;

class Group
{
    /** @var Id */
    private $id;

    /** @var string */
    private $name;

    /** @var Id */
    private $createdByUserId;

    /** @var DateTimeImmutable */
    private $createdAt;

    /** @var DateTimeImmutable */
    private $updatedAt;

    /** @var DateTimeImmutable */
    private $deletedAt;

    /**
     * Group constructor.
     *
     * @param Id                     $id
     * @param string                 $name
     * @param Id                     $createdByUserId
     * @param DateTimeImmutable      $createdAt
     * @param DateTimeImmutable      $updatedAt
     * @param DateTimeImmutable|null $deletedAt
     */
    private function __construct(
        Id $id,
        string $name,
        Id $createdByUserId,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $deletedAt
    ) {
        $this->id              = $id;
        $this->name            = $name;
        $this->createdByUserId = $createdByUserId;
        $this->createdAt       = $createdAt;
        $this->updatedAt       = $updatedAt;
        $this->deletedAt       = $deletedAt;
    }

    /**
     * @param Id                     $id
     * @param string                 $name
     * @param Id                     $createdByUserId
     * @param DateTimeImmutable      $createdAt
     * @param DateTimeImmutable      $updatedAt
     * @param DateTimeImmutable|null $deletedAt
     *
     * @return Group
     */
    public static function buildFromValues(
        Id $id,
        string $name,
        Id $createdByUserId,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $deletedAt
    ) {
        return new self($id, $name, $createdByUserId, $createdAt, $updatedAt, $deletedAt);
    }

//    public static function buildFromEntity()
//    {
//
//    }

    /**
     * @return Id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Id
     */
    public function createdByUserId(): Id
    {
        return $this->createdByUserId;
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