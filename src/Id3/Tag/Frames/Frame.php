<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 26.08.17
 * Time: 7:50
 */

namespace Id3\Tag\Frames;


class Frame
{
    /** @var FrameHeader */
    private $frameHeader;
    /** @var string */
    private $frameContent;

    public function __construct(FrameHeader $frameHeader, string $content)
    {
        $this->frameHeader = $frameHeader;
        $this->frameContent = $content;
    }

}