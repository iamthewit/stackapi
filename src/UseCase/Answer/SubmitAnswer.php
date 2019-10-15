<?php

namespace App\UseCase\Answer;

use App\Factory\EntityFactory;
use App\Stack\Answer;
use App\Factory\IdFactory;
use App\Stack\Question;
use App\Stack\User;
use App\UseCase\Exception\CanNotPersistAnswerEntityException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;

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

    /**
     * @param Question $question
     * @param string   $answerText
     * @param User     $user
     *
     * @return Answer
     * @throws CanNotPersistAnswerEntityException
     */
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

        try {
            $this->entityManager->persist($answerEntity);
            $this->entityManager->flush();
        } catch(ORMException $e) {
            $m = 'Can not persist answer entity';
            throw new CanNotPersistAnswerEntityException($m, 0, $e);
        }

        // TODO: send answer created event
        return $answer;
    }
}