<?php

namespace Id3\Tag\Frames;


/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 26.08.17
 * Time: 0:24
 */
class FrameHeader
{
    /** @var string */
    private $frameId;
    /** @var int */
    private $size;
    /** @var string */
    private $flags;

    public function __construct(string $header)
    {
        $this->frameId = $this->readFrameId($header);
        $this->size = $this->readHeaderSize($header);
        $this->flags = $this->readFlags($header);
    }

    private function readFrameId(string $header): string
    {
        return substr($header, 0, 4);
    }

    private function readHeaderSize(string $header): int
    {
        return hexdec(bin2hex(substr($header, 4, 4)));
    }

    private function readFlags(string $header): string
    {
        return substr($header, 8, 2);
    }

    public function getSize(): int
    {
        return $this->size;
    }

}