<?php

declare(strict_types=1);

namespace Task1;

use UnexpectedValueException;
use function file_get_contents;
use function is_string;

class FileGetContentsWrapper
{
    public function fileGetContents(string $filename) : string
    {
        $result = file_get_contents($filename);
        if (! is_string($result)) {
            throw new UnexpectedValueException('expected string in treeData');
        }

        return $result;
    }
}
