<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 25.08.17
 * Time: 23:22
 */

namespace Id3\Tag;


class Flags
{

    private $unsynchronisation;
    private $extenderHeader;
    private $experimentalIndicator;

    public function __construct(string $flags)
    {
        $this->unsynchronisation = ($flags >> 7) & bindec('0');
        $this->extenderHeader = ($flags >> 6) & bindec('01');
        $this->experimentalIndicator = ($flags >> 5) & bindec('001');
    }

    public function hasUnsynchronization(): bool
    {
        return (bool)$this->unsynchronisation;
    }

    public function hasExtendedHeader(): bool
    {
        return (bool)$this->extenderHeader;
    }

    public function hasExperimentalIndicator(): bool
    {
        return (bool)$this->experimentalIndicator;
    }

}