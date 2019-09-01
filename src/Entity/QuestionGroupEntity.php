<?php

namespace App\Entity;

use App\Stack\Group;
use App\Stack\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionGroupEntityRepository")
 * @ORM\Table(name="question_group")
 */
class QuestionGroupEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserEntity", inversedBy="groupEntities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionEntity", mappedBy="question_group")
     */
    private $questionEntities;

    public function __construct()
    {
        $this->questionEntities = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setUser(?UserEntity $user): self
    {
        $this->user = $user;

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

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

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
            $questionEntity->setQuestionGroup($this);
        }

        return $this;
    }

    public function removeQuestionEntity(QuestionEntity $questionEntity): self
    {
        if ($this->questionEntities->contains($questionEntity)) {
            $this->questionEntities->removeElement($questionEntity);
            // set the owning side to null (unless already changed)
            if ($questionEntity->getQuestionGroup() === $this) {
                $questionEntity->setQuestionGroup(null);
            }
        }

        return $this;
    }
}
