<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 26.08.17
 * Time: 12:32
 */

namespace Id3\Tag\Frames;


use Id3\Exceptions\FrameTypeNotFoundException;

class FrameFactory
{
    public static function create(string $type, FrameHeader $frameHeader, string $content): Frame
    {
        $className = 'Id3\Tag\Frames\Frame'. strtoupper($type);
        if (!class_exists($className, true)) {
            throw new FrameTypeNotFoundException("Frame type doesn't exist");
        }
        return new $className($frameHeader, $content);
    }
}