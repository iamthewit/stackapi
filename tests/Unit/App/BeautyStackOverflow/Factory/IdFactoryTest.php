<?php

namespace App\Tests\Unit\App\BeautyStackOverflow\Factory;

use App\BeautyStackOverflow\Factory\IdFactory;
use App\BeautyStackOverflow\Id;
use Exception;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidFactory;

class IdFactoryTest extends TestCase
{
    public function testItCreatesAnId()
    {
        $idFactory = new IdFactory(new UuidFactory());

        $this->assertInstanceOf(Id::class, $idFactory->buildFromRamseyUuid());
    }

    /**
     * @expectedException App\BeautyStackOverflow\Factory\Exception\CanNotCreateIdException
     * @expectedExceptionMessage Unable to create uuid.
     */
    public function testItThrowsCanNotCreateIdException()
    {
        $uuidFactoryMock = $this->createMock(UuidFactory::class);
        $uuidFactoryMock->method('uuid4')->willThrowException(new Exception());

        $idFactory = new IdFactory($uuidFactoryMock);
        $idFactory->buildFromRamseyUuid();
    }
}
