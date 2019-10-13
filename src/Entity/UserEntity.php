<?php

namespace App\Entity;

use App\Stack\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserEntityRepository")
 * @ORM\Table(name="user")
 */
class UserEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="QuestionGroupEntity", mappedBy="user")
     */
    private $groupEntities;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionEntity", mappedBy="user")
     */
    private $questionEntities;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AnswerEntity", mappedBy="user")
     */
    private $answerEntities;

    public function __construct()
    {
        $this->groupEntities = new ArrayCollection();
        $this->questionEntities = new ArrayCollection();
        $this->answerEntities = new ArrayCollection();
    }

    /**
     * @param User $user
     *
     * @return UserEntity
     *
     * TODO: move this to EntityFactory
     */
    public static function buildFromUser(User $user): UserEntity
    {
        $userEntity = new self();
        $userEntity->setId($user->id()->value())
                   ->setUsername($user->username())
                   ->setEmail($user->email())
                   ->setPassword($user->password())
                   ->setCreatedAt($user->createdAt())
                   ->setUpdatedAt($user->updatedAt())
                   ->setDeletedAt($user->deletedAt());

        return $userEntity;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return Collection|QuestionGroupEntity[]
     */
    public function getGroupEntities(): Collection
    {
        return $this->groupEntities;
    }

    public function addGroupEntity(QuestionGroupEntity $groupEntity): self
    {
        if (!$this->groupEntities->contains($groupEntity)) {
            $this->groupEntities[] = $groupEntity;
            $groupEntity->setUser($this);
        }

        return $this;
    }

    public function removeGroupEntity(QuestionGroupEntity $groupEntity): self
    {
        if ($this->groupEntities->contains($groupEntity)) {
            $this->groupEntities->removeElement($groupEntity);
            // set the owning side to null (unless already changed)
            if ($groupEntity->getUser() === $this) {
                $groupEntity->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|QuestionEntity[]
     */
    public function getQuestionEntities(): Collection
    {
        return $this->questionEntities;
    }

    public function addQuestionEntity(QuestionEntity $questionEntity): self
    {
        if (!$this->questionEntities->contains($questionEntity)) {
            $this->questionEntities[] = $questionEntity;
            $questionEntity->setUser($this);
        }

        return $this;
    }

    public function removeQuestionEntity(QuestionEntity $questionEntity): self
    {
        if ($this->questionEntities->contains($questionEntity)) {
            $this->questionEntities->removeElement($questionEntity);
            // set the owning side to null (unless already changed)
            if ($questionEntity->getUser() === $this) {
                $questionEntity->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AnswerEntity[]
     */
    public function getAnswerEntities(): Collection
    {
        return $this->answerEntities;
    }

    public function addAnswerEntity(AnswerEntity $answerEntity): self
    {
        if (!$this->answerEntities->contains($answerEntity)) {
            $this->answerEntities[] = $answerEntity;
            $answerEntity->setUser($this);
        }

        return $this;
    }

    public function removeAnswerEntity(AnswerEntity $answerEntity): self
    {
        if ($this->answerEntities->contains($answerEntity)) {
            $this->answerEntities->removeElement($answerEntity);
            // set the owning side to null (unless already changed)
            if ($answerEntity->getUser() === $this) {
                $answerEntity->setUser(null);
            }
        }

        return $this;
    }
}
