<?php

namespace App\Tests\Integration\App\UseCase\Question;

use App\Stack\Factory\IdFactory;
use App\Stack\Group;
use App\Stack\Question;
use App\Stack\User;
use App\Entity\QuestionEntity;
use App\Repository\QuestionEntityRepository;
use App\Tests\Integration\IntegrationTest;
use App\UseCase\Group\CreateGroup;
use App\UseCase\Question\AskQuestion;
use App\UseCase\User\RegisterUser;

class AskQuestionTest extends IntegrationTest
{
    public function testItReturnsQuestionObject()
    {
        $user = $this->createUser();
        $group = $this->createGroup($user);

        /** @var AskQuestion $useCase */
        $useCase = self::$container->get(AskQuestion::class);
        $question = $useCase->execute($group, $user, 'abc');

        $this->assertInstanceOf(Question::class, $question);
    }

    public function testItStoresQuestionInDatabase()
    {
        $user = $this->createUser();
        $group = $this->createGroup($user);

        /** @var AskQuestion $useCase */
        $useCase = self::$container->get(AskQuestion::class);
        $useCase->execute($group, $user, 'abc');

        $questionRepo = self::$container->get(QuestionEntityRepository::class);
        $result = $questionRepo->findOneBy(['text' => 'abc']);

        $this->assertInstanceOf(QuestionEntity::class, $result);
        $this->assertEquals('abc', $result->getText());
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
}
