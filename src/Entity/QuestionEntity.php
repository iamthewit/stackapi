<?php

namespace App\Entity;

use App\Stack\Question;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionEntityRepository")
 * @ORM\Table(name="question")
 */
class QuestionEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionGroupEntity", inversedBy="questionEntities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question_group;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserEntity", inversedBy="questionEntities")
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
     * @ORM\OneToMany(targetEntity="App\Entity\AnswerEntity", mappedBy="question")
     */
    private $answerEntities;

    public function __construct()
    {
        $this->answerEntities = new ArrayCollection();
    }

    /**
     * @param Question            $question
     * @param QuestionGroupEntity $questionGroupEntity
     * @param UserEntity          $userEntity
     *
     * @return QuestionEntity
     *
     * TODO: move this to EntityFactory
     */
    public static function buildFromQuestionAndQuestionGroupEntityAndUserEntity(
        Question $question,
        QuestionGroupEntity $questionGroupEntity,
        UserEntity $userEntity
    ) {
        $questionEntity = new self();
        $questionEntity->setId($question->id()->value())
            ->setText($question->text())
            ->setQuestionGroup($questionGroupEntity)
            ->setUser($userEntity)
            ->setCreatedAt($question->createdAt())
            ->setUpdatedAt($question->updatedAt())
            ->setDeletedAt($question->deletedAt());

        return $questionEntity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return QuestionEntity
     */
    public function setId(string $id): QuestionEntity
    {
        $this->id = $id;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getQuestionGroup(): ?QuestionGroupEntity
    {
        return $this->question_group;
    }

    public function setQuestionGroup(?QuestionGroupEntity $question_group): self
    {
        $this->question_group = $question_group;

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
            $answerEntity->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswerEntity(AnswerEntity $answerEntity): self
    {
        if ($this->answerEntities->contains($answerEntity)) {
            $this->answerEntities->removeElement($answerEntity);
            // set the owning side to null (unless already changed)
            if ($answerEntity->getQuestion() === $this) {
                $answerEntity->setQuestion(null);
            }
        }

        return $this;
    }
}
