<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 25.08.17
 * Time: 23:11
 */

namespace Id3\Tag;


class TagConstants
{
    const ID3_LENGTH = 3;
    const VERSION_OFFSET = 3;
    const VERSION_HEADER_LENGTH = 1;
    const FLAGS_OFFSET = 5;
    const FLAGS_HEADER_LENGTH = 1;
    const SIZE_OFFSET = 6;
    const SIZE_HEADER_LENGTH = 4;
    const EXTENDED_HEADER_OFFSET = 10;
    const FRAME_HEADER_LENGTH = 10;

    public static function calculateFramesOffset(): int
    {
        return self::ID3_LENGTH + self::VERSION_HEADER_LENGTH + self::VERSION_HEADER_LENGTH + self::FLAGS_HEADER_LENGTH + self::SIZE_HEADER_LENGTH;
    }
}