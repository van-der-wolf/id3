<?php

namespace Id3;

use Id3\Exceptions\TagNotFoundException;
use Id3\Tag\Id3v23;
use Id3\Tag\Id3v24;
use Id3\Tag\IdTag;

/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 25.08.17
 * Time: 22:52
 */
class Mp3File
{
    /** @var bool|resource */
    private $file;
    /** @var IdTag */
    private $tag;

    public function __construct(string $fileName)
    {
        $this->file = new File($fileName, 'rb');
        $this->tag = $this->readTag($this->file);
    }

    private function readTag(File $file): IdTag
    {
        try {
            return new Id3v24($file);
        } catch (TagNotFoundException $exception) {
        }
        try {
            return new Id3v23($file);
        } catch (TagNotFoundException $exception) {

        }
    }


}