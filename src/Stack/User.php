<?php

namespace App\Stack;

use App\Entity\UserEntity;
use DateTimeImmutable;
use JsonSerializable;

class User implements JsonSerializable
{
    /** @var Id */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var DateTimeImmutable */
    private $createdAt;

    /** @var DateTimeImmutable */
    private $updatedAt;

    /** @var DateTimeImmutable */
    private $deletedAt;

    /**
     * User constructor.
     *
     * @param Id                     $id
     * @param string                 $username
     * @param string                 $email
     * @param string                 $password
     * @param DateTimeImmutable      $createdAt
     * @param DateTimeImmutable      $updatedAt
     * @param DateTimeImmutable|null $deletedAt
     */
    private function __construct(
        Id $id,
        string $username,
        string $email,
        string $password,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $deletedAt
    ) {
        $this->id        = $id;
        $this->username  = $username;
        $this->email     = $email;
        $this->password  = $password;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    /**
     * @param Id                     $id
     * @param string                 $username
     * @param string                 $email
     * @param string                 $password
     * @param DateTimeImmutable      $createdAt
     * @param DateTimeImmutable      $updatedAt
     * @param DateTimeImmutable|null $deletedAt
     *
     * @return User
     */
    public static function buildFromValues(
        Id $id,
        string $username,
        string $email,
        string $password,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $deletedAt
    ) {
        return new self($id, $username, $email, $password, $createdAt, $updatedAt, $deletedAt);
    }

    /**
     * @param UserEntity $userEntity
     *
     * @return User
     */
    public static function buildFromEntity(UserEntity $userEntity): User
    {
        return new self(
            Id::buildFromValue($userEntity->getId()),
            $userEntity->getUsername(),
            $userEntity->getEmail(),
            $userEntity->getPassword(),
            $userEntity->getCreatedAt(),
            $userEntity->getUpdatedAt(),
            $userEntity->getDeletedAt()
        );
    }

    /**
     * @return Id
     */
    public function id(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
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

    /**
     * Specify data which should be serialized to JSON
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     *
     *  TODO: add test for json serialisation
     */
    public function jsonSerialize()
    {
        return [
            'id'        => $this->id,
            'username'  => $this->username,
            'email'     => $this->email,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}