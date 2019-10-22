<?php

namespace App\Http;

class Response implements \JsonSerializable
{
    /** @var object|array */
    private $data;

    /** @var Meta */
    private $meta;

    /**
     * Response constructor.
     *
     * @param array|object $data
     * @param Meta         $meta
     */
    public function __construct($data, Meta $meta)
    {
        $this->data = $data;
        $this->meta = $meta;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'data' => $this->data,
            'meta' => $this->meta
        ];
    }
}