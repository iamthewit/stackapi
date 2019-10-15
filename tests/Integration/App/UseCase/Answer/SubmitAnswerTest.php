<?php

namespace App\Tests\Integration\App\UseCase\Answer;

use App\Entity\AnswerEntity;
use App\Repository\AnswerEntityRepository;
use App\Stack\Answer;
use App\Stack\Group;
use App\Stack\Question;
use App\Stack\User;
use App\Tests\Integration\IntegrationTest;
use App\UseCase\Answer\SubmitAnswer;
use App\UseCase\Group\CreateGroup;
use App\UseCase\Question\AskQuestion;
use App\UseCase\User\RegisterUser;

class SubmitAnswerTest extends IntegrationTest
{
    public function testItReturnsAnswerObject()
    {
        $user = $this->createUser();
        $group = $this->createGroup($user);
        $question = $this->createQuestion($user, $group);

        $useCase = self::$container->get(SubmitAnswer::class);

        $result = $useCase->execute($question, 'answer text', $user);

        $this->assertInstanceOf(Answer::class, $result);
    }

    public function testItStoresAnswerInRepository()
    {
        $user = $this->createUser();
        $group = $this->createGroup($user);
        $question = $this->createQuestion($user, $group);
        $answerText = 'answer text';

        $useCase = self::$container->get(SubmitAnswer::class);

        $useCase->execute($question, $answerText, $user);

        $entityManager = self::$container->get('doctrine.orm.entity_manager');
        $qb = $entityManager->createQueryBuilder();
        $queryResultCount = $qb->select('count(a.id)')
            ->from(AnswerEntity::class, 'a')
            ->where('a.text = :answerText')
            ->setParameter('answerText', $answerText)
            ->getQuery()
            ->getSingleScalarResult();

        $this->assertEquals(1, $queryResultCount);
    }

    /**
     * @return User
     */
    private function createUser(): User
    {
        // create user
        $useCase = self::$container->get(RegisterUser::class);
        return $useCase->execute('123', '123', '123');
    }

    /**
     * @param User $user
     *
     * @return Group
     */
    private function createGroup(User $user): Group
    {
        // create group
        $useCase = self::$container->get(CreateGroup::class);
        return $useCase->execute('123', $user);
    }

    /**
     * @param User  $user
     * @param Group $group
     *
     * @return Question
     */
    private function createQuestion(User $user, Group $group): Question
    {
        $useCase = self::$container->get(AskQuestion::class);
        return $useCase->execute($group, $user, 'question text');
    }
}
