<?php

namespace App\Factory;

use App\Entity\AnswerEntity;
use App\Entity\QuestionEntity;
use App\Entity\QuestionGroupEntity;
use App\Entity\UserEntity;
use App\Repository\QuestionEntityRepository;
use App\Repository\QuestionGroupEntityRepository;
use App\Repository\UserEntityRepository;
use App\Stack\Answer;
use App\Stack\Group;
use App\Stack\Question;
use App\Stack\User;

/**
 * Class EntityFactory
 * @package App\Stack\Factory
 * @author  Ben Cross <bencross86@gmail.com>
 */
class EntityFactory
{
    /** @var UserEntityRepository */
    private $userEntityRepository;

    /** @var QuestionGroupEntityRepository */
    private $questionGroupEntityRepository;

    /** @var QuestionEntityRepository */
    private $questionEntityRepository;

    /**
     * EntityFactory constructor.
     *
     * @param UserEntityRepository          $userEntityRepository
     * @param QuestionGroupEntityRepository $questionGroupEntityRepository
     * @param QuestionEntityRepository      $questionEntityRepository
     */
    public function __construct(
        UserEntityRepository $userEntityRepository,
        QuestionGroupEntityRepository $questionGroupEntityRepository,
        QuestionEntityRepository $questionEntityRepository
    ) {
        $this->userEntityRepository = $userEntityRepository;
        $this->questionGroupEntityRepository = $questionGroupEntityRepository;
        $this->questionEntityRepository = $questionEntityRepository;
    }

    /**
     * @param User $user
     *
     * @return UserEntity
     */
    public function buildUserEntity(User $user): UserEntity
    {
        $userEntity = new UserEntity();
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
     * @param Group $group
     *
     * @return QuestionGroupEntity
     */
    public function buildQuestionGroupEntity(Group $group): QuestionGroupEntity
    {
        $userEntity = $this->userEntityRepository->find($group->createdByUserId()->value());

        $groupEntity = new QuestionGroupEntity();
        $groupEntity->setId($group->id()->value())
                    ->setName($group->name())
                    ->setUser($userEntity)
                    ->setCreatedAt($group->createdAt())
                    ->setUpdatedAt($group->updatedAt())
                    ->setDeletedAt($group->deletedAt());

        return $groupEntity;
    }

    /**
     * @param Question $question
     *
     * @return QuestionEntity
     */
    public function buildQuestionEntity(Question $question) {
        $questionGroupEntity = $this->questionGroupEntityRepository->find($question->groupId()->value());
        $userEntity = $this->userEntityRepository->find($question->userId()->value());

        $questionEntity = new QuestionEntity();
        $questionEntity->setId($question->id()->value())
                       ->setText($question->text())
                       ->setQuestionGroup($questionGroupEntity)
                       ->setUser($userEntity)
                       ->setCreatedAt($question->createdAt())
                       ->setUpdatedAt($question->updatedAt())
                       ->setDeletedAt($question->deletedAt());

        return $questionEntity;
    }

    /**
     * @param Answer $answer
     *
     * @return AnswerEntity
     */
    public function buildAnswerEntity(Answer $answer): AnswerEntity
    {
        $questionEntity = $this->questionEntityRepository->find($answer->questionId()->value());
        $userEntity = $this->userEntityRepository->find($answer->userId()->value());

        $answerEntity = new AnswerEntity();
        $answerEntity->setId($answer->id()->value())
            ->setText($answer->text())
            ->setQuestion($questionEntity)
            ->setUser($userEntity)
            ->setCreatedAt($answer->createdAt())
            ->setUpdatedAt($answer->updatedAt())
            ->setDeletedAt($answer->deletedAt());

        return $answerEntity;
    }
}