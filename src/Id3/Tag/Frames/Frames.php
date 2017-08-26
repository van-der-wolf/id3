<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 26.08.17
 * Time: 7:49
 */

namespace Id3\Tag\Frames;


class Frames
{

    /** @var array */
    private $frames = [];

    public function addFrame(Frame $frame): Frames
    {
        $this->frames[] = $frame;
        return $this;
    }

}