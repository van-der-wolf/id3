<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 26.08.17
 * Time: 18:28
 */

namespace Id3\Tag;


use Id3\Exceptions\TagNotFoundException;
use Id3\File;

class Id3TagV1
{
    /** @var string */
    private $title;
    /** @var string */
    private $artist;
    /** @var string */
    private $album;
    /** @var string */
    private $year;
    /** @var string */
    private $comment;
    /** @var bool */
    private $zeroByte;
    /** @var int */
    private $track;
    /** @var string */
    private $genre;

    public function __construct(File $file)
    {
        fseek($file->getResource(), filesize($file->getName()) - 128);
        $tagId = fread($file->getResource(), 3);
        if ($tagId !== 'TAG') {
            throw new TagNotFoundException('Id tag v1 not found');
        }
        $this->title = $this->readTitle($file);
        $this->artist = $this->readArtist($file);
        $this->album = $this->readAlbum($file);
        $this->year = $this->readYear($file);
        $this->comment = $this->readComment($file);
        $this->zeroByte = $this->readZeroByte($file);
        if ($this->zeroByte) {
            $this->track = $this->readTrackNumber($file);
        } else {
            fseek($file->getResource(), ftell($file->getResource()) + 1);
        }

        $this->genre = $this->readGenre($file);
    }

    private function readTitle(File $file): string
    {
        return fread($file->getResource(), 30);
    }

    private function readArtist(File $file): string
    {
        return fread($file->getResource(), 30);
    }

    private function readAlbum(File $file): string
    {
        return fread($file->getResource(), 30);
    }

    private function readYear(File $file): string
    {
        return fread($file->getResource(), 4);
    }

    private function readComment(File $file): string
    {
        return fread($file->getResource(), 28);
    }

    private function readZeroByte(File $file): bool
    {
        $zeroByte = fread($file->getResource(), 1);
        return (bool)hexdec(bin2hex($zeroByte));
    }

    private function readTrackNumber(File $file): int
    {
        return hexdec(bin2hex(fread($file->getResource(), 1)));
    }

    private function readGenre(File $file): int
    {
        return hexdec(bin2hex(fread($file->getResource(), 1)));
    }
}