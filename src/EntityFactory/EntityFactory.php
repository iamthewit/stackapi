<?php

namespace App\EntityFactory;

use App\Entity\QuestionEntity;
use App\Entity\QuestionGroupEntity;
use App\Entity\UserEntity;
use App\Repository\QuestionGroupEntityRepository;
use App\Repository\UserEntityRepository;
use App\Stack\Group;
use App\Stack\Question;
use App\Stack\User;

/**
 * Class EntityFactory
 * @package App\Stack\Factory
 * @author  Ben Cross <ben@beautystack.com>
 */
class EntityFactory
{
    /** @var UserEntityRepository */
    private $userEntityRepository;

    /** @var QuestionGroupEntityRepository */
    private $questionGroupEntityRepository;

    /**
     * EntityFactory constructor.
     *
     * @param UserEntityRepository          $userEntityRepository
     * @param QuestionGroupEntityRepository $questionGroupEntityRepository
     */
    public function __construct(
        UserEntityRepository $userEntityRepository,
        QuestionGroupEntityRepository $questionGroupEntityRepository
    ) {
        $this->userEntityRepository = $userEntityRepository;
        $this->questionGroupEntityRepository = $questionGroupEntityRepository;
    }

    /**
     * @param User $user
     *
     * @return UserEntity
     */
    public function buildUserEntityFromUser(User $user): UserEntity
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
     * @param User  $user
     *
     * @return QuestionGroupEntity
     */
    public function buildQuestionGroupEntityFromGroupAndUser(Group $group, User $user): QuestionGroupEntity
    {
        $userEntity = $this->userEntityRepository->find($user->id()->value());

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
     * @param Group    $group
     * @param User     $user
     *
     * @return QuestionEntity
     */
    public function buildQuestionEntityFromQuestionAndGroupAndUser(
        Question $question,
        Group $group,
        User $user
    ) {
        $questionGroupEntity = $this->questionGroupEntityRepository->find($group->id()->value());
        $userEntity = $this->userEntityRepository->find($user->id()->value());

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
}