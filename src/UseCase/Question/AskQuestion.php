<?php

namespace App\UseCase\Question;

use App\Factory\EntityFactory;
use App\Factory\IdFactory;
use App\Stack\Group;
use App\Stack\Question;
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
        $questionEntity = $this->entityFactory->buildQuestionEntity($question);

        // store the question in the DB
        $this->entityManager->persist($questionEntity);
        $this->entityManager->flush();

        // TODO: fire questionAskedEvent

        return $question;
    }
}