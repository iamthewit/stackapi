<?php

namespace App\Stack;

class Id
{
    /** @var string */
    private $value;

    /**
     * Id constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @return Id
     */
    public static function buildFromValue(string $value)
    {
        return new self($value);
    }

    public function value()
    {
        return $this->value;
    }
}