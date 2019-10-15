<?php

namespace App\Stack;

use JsonSerializable;

class Id implements JsonSerializable
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

    /**
     * Specify data which should be serialized to JSON
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     *
     * TODO: add test for serialisation
     */
    public function jsonSerialize()
    {
        return [
            'value'=> $this->value
        ];
    }
}