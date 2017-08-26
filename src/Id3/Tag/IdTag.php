<?php

namespace Id3\Tag;

use Id3\Exceptions\TagNotFoundException;
use Id3\File;
use Id3\Tag\Frames\Frame;
use Id3\Tag\Frames\FrameHeader;
use Id3\Tag\Frames\Frames;

/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 25.08.17
 * Time: 22:54
 */
abstract class IdTag
{

    /** @var int */
    protected $version;
    /** @var Flags */
    protected $flags;
    /** @var int */
    protected $size;
    /** @var array */
    protected $frames;
    protected $extendedHeader;

    public function __construct(File $file)
    {
        $this->version;
        $this->read($file);
    }


    protected function read(File $file)
    {
        fseek($file->getResource(), 0);
        $tag = fread($file->getResource(), 3);
        $this->version = $this->readMajorVersion($file);
        $this->flags = $this->readFlags($file);
        if ($this->flags->hasExtendedHeader()) {
            $this->extendedHeader = new ExtendedHeader($file);
        }
        $this->size = $this->readSize($file);
        $this->frames = $this->readFrames($file);
    }

    protected function readMajorVersion(File $file): int
    {
        fseek($file->getResource(), TagConstants::VERSION_OFFSET);
        $majorVersion = fread($file->getResource(), TagConstants::VERSION_HEADER_LENGTH);
        $revision = fread($file->getResource(), TagConstants::VERSION_HEADER_LENGTH);
        if (!$this->checkVersion($majorVersion, $revision)) {
            throw new TagNotFoundException('Tag not found');
        }
        fseek($file->getResource(), TagConstants::VERSION_OFFSET);
        return (int)bin2hex(fread($file->getResource(), TagConstants::VERSION_HEADER_LENGTH));
    }

    protected function readFlags(File $file): Flags
    {
        fseek($file->getResource(), TagConstants::FLAGS_OFFSET);
        $flags = fread($file->getResource(), TagConstants::FLAGS_HEADER_LENGTH);

        return new Flags($flags);
    }

    protected function readSize(File $file): int
    {
        fseek($file->getResource(), TagConstants::SIZE_OFFSET);
        $size = fread($file->getResource(), TagConstants::SIZE_HEADER_LENGTH);
        return hexdec(bin2hex($size));
    }

    protected function readFrames(File $file): Frames
    {
        $frames = new Frames();
        $offset = TagConstants::calculateFramesOffset();
        while ($offset < $this->size) {
            $frameHeader = $this->readFrameHeader($file, $offset);
            if (!$frameHeader->getSize()) {
                break;
            }
            $offset = $offset + TagConstants::FRAME_HEADER_LENGTH;
            $frames->addFrame($this->createFrame($frameHeader, $file, $offset));
            $offset = $offset + $frameHeader->getSize();
        }

        return $frames;
    }

    private function createFrame(FrameHeader $frameHeader, File $file, int $offset): Frame
    {
        fseek($file->getResource(), $offset);
        $frameContent = fread($file->getResource(), $frameHeader->getSize());
        return new Frame($frameHeader, $frameContent);
    }

    private function readFrameHeader(File $file, int $offset): FrameHeader
    {
        fseek($file->getResource(), $offset);
        $string = fread($file->getResource(), TagConstants::FRAME_HEADER_LENGTH);
        return new FrameHeader($string);
    }

    abstract protected function checkVersion(string $majorVersion, string $revision): bool;

}