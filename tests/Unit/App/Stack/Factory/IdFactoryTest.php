<?php

namespace App\Tests\Unit\App\Stack\Factory;

use App\Stack\Factory\IdFactory;
use App\Stack\Id;
use PHPUnit\Framework\TestCase;

class IdFactoryTest extends TestCase
{
    public function testItCreatesAnId()
    {
        $this->assertInstanceOf(Id::class, IdFactory::generateFromRandom());
    }
}
