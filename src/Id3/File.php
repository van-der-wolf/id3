<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 25.08.17
 * Time: 23:50
 */

namespace Id3;


class File
{

    /** @var string */
    private $fileName;
    /** @var bool|resource */
    private $resource;

    public function __construct(string $fileName, string $readMode)
    {
        $this->fileName = $fileName;
        $this->resource = fopen($fileName, $readMode);
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function getName(): string
    {
        return $this->fileName;
    }

}