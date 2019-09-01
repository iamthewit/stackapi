<?php

namespace App\UseCase\Question;

use App\EntityFactory\EntityFactory;
use App\Stack\Factory\IdFactory;
use App\Stack\Group;
use App\Stack\Id;
use App\Stack\Question;
use App\Entity\QuestionEntity;
use App\Repository\QuestionGroupEntityRepository;
use App\Repository\UserEntityRepository;
use App\Stack\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AskQuestion
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var EntityFactory */
    private $entityFactory;

    /**
     * AskQuestion constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param EntityFactory          $entityFactory
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EntityFactory $entityFactory
    ) {
        $this->entityManager = $entityManager;
        $this->entityFactory = $entityFactory;
    }

    /**
     * @param Group  $group
     * @param User   $user
     * @param string $questionText
     *
     * @return Question
     * @throws Exception
     */
    public function execute(Group $group, User $user, string $questionText): Question
    {
        // create question object
        $question = Question::buildFromValues(
            IdFactory::generateFromRandom(),
            $group->id(),
            $user->id(),
            $questionText,
            null,
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            null
        );

        // create question entity
        $questionEntity = $this->entityFactory->buildQuestionEntityFromQuestionAndGroupAndUser(
            $question,
            $group,
            $user
        );

        // store the question in the DB
        $this->entityManager->persist($questionEntity);
        $this->entityManager->flush();

        return $question;
    }
}