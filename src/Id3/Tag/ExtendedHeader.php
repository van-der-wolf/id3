<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 26.08.17
 * Time: 7:36
 */

namespace Id3\Tag;

use Id3\File;

class ExtendedHeader
{

    private $extendedHeaderSize;
    private $flags;
    private $sizeOfPadding;

    public function __construct(File $file)
    {
        fseek($file->getResource(), TagConstants::EXTENDED_HEADER_OFFSET);
        $extendedHeader = fread($file->getResource(), )
        $this->extendedHeaderSize = $this->readHeaderSize($file);
        $this->flags = $this->readFlags($file);
        $this->sizeOfPadding = $this->readSizeOfPadding($file);
    }

    private function readHeaderSize(File $file): int
    {


    }

    private function readFlags(File $file): ExtendedHeaderFlags
    {

    }

    private function readSizeOfPadding(File $file): int
    {

    }

}