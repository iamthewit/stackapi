<?php

namespace App\BeautyStackOverflow\Factory;

use App\BeautyStackOverflow\Factory\Exception\CanNotCreateIdException;
use App\BeautyStackOverflow\Id;
use Exception;
use Ramsey\Uuid\UuidFactory;

class IdFactory
{
    /** @var UuidFactory */
    private $ramsey;

    /**
     * IdFactory constructor.
     *
     * @param UuidFactory $ramsey
     */
    public function __construct(UuidFactory $ramsey)
    {
        $this->ramsey = $ramsey;
    }

    /**
     * @return Id
     * @throws CanNotCreateIdException
     */
    public function buildFromRamseyUuid(): Id
    {
        try {
            $uuid = $this->ramsey->uuid4();

            return Id::buildFromValue($uuid->toString());
        } catch (Exception $e) {
            $m = 'Unable to create uuid.';
            throw new CanNotCreateIdException($m, 0, $e);
        }
    }
}