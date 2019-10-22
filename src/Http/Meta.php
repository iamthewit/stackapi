<?php

namespace App\Http;

class Meta implements \JsonSerializable
{
    /** @var string */
    private $uri;

    /** @var int */
    private $resultCount;

    /** @var Link[] */
    private $links;

    // TODO:
        // add full path + query string
        // add array of query string params
        // add path without query string

    /**
     * Meta constructor.
     *
     * @param string $uri
     * @param int    $resultCount
     * @param Link[] $links
     */
    public function __construct(string $uri, int $resultCount, array $links)
    {
        $this->uri         = $uri;
        $this->resultCount = $resultCount;
        $this->links       = $links;
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
            'uri'         => $this->uri,
            'resultCount' => $this->resultCount,
            'links'       => $this->links,
        ];
    }
}