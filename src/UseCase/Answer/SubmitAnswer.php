<?php

namespace App\UseCase\Answer;

use App\Factory\EntityFactory;
use App\Stack\Answer;
use App\Factory\IdFactory;
use App\Stack\Question;
use App\Stack\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SubmitAnswer
 * @package App\UseCase\Answer
 * @author  Ben Cross <bencross86@gmail.com>
 */
class SubmitAnswer
{
    /** @var IdFactory */
    private $idFactory;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var EntityFactory */
    private $entityFactory;

    /**
     * SubmitAnswer constructor.
     *
     * @param IdFactory              $idFactory
     * @param EntityManagerInterface $entityManager
     * @param EntityFactory          $entityFactory
     */
    public function __construct(
        IdFactory $idFactory,
        EntityManagerInterface $entityManager,
        EntityFactory $entityFactory
    ) {
        $this->idFactory     = $idFactory;
        $this->entityManager = $entityManager;
        $this->entityFactory = $entityFactory;
    }


    public function execute(Question $question, string $answerText, User $user)
    {
        $answer = Answer::buildFromValues(
            $this->idFactory->generateFromRandom(),
            $question->id(),
            $user->id(),
            $answerText,
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
            null
        );

        $answerEntity = $this->entityFactory->buildAnswerEntity($answer);

        $this->entityManager->persist($answerEntity);
        $this->entityManager->flush();

        return $answer;
    }
}