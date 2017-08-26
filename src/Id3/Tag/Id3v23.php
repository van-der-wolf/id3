<?php
/**
 * Created by PhpStorm.
 * User: wolfie
 * Date: 25.08.17
 * Time: 22:57
 */

namespace Id3\Tag;


class Id3v23 extends IdTag
{

    protected function checkVersion(string $majorVersion, string $revision): bool
    {
        $majorVersion = bin2hex($majorVersion);
        if ((int) $majorVersion === 3) {
            return true;
        }
        return false;
    }

}