<?php

namespace Id3;

use Id3\Exceptions\TagNotFoundException;
use Id3\Tag\Id3TagV1;
use Id3\Tag\Id3V23;
use Id3\Tag\Id3V24;
use Id3\Tag\Id3TagV2;

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
    /** @var Id3TagV2 */
    private $tagV2;
    private $tagV1;

    public function __construct(string $fileName)
    {
        $this->file = new File($fileName, 'rb');
        $this->tagV1 = $this->readV1Tag($this->file);
        $this->tagV2 = $this->readV2Tag($this->file);
    }

    private function readV1Tag(File $file): Id3TagV1
    {
        try {
            return new Id3TagV1($file);
        } catch (TagNotFoundException $exception) {
            return null;
        }
    }

    private function readV2Tag(File $file): Id3TagV2
    {
        try {
            return new Id3V24($file);
        } catch (TagNotFoundException $exception) {
        }
        try {
            return new Id3V23($file);
        } catch (TagNotFoundException $exception) {
        }
        try {

        } catch (TagNotFoundException $exception) {
        }
    }


}