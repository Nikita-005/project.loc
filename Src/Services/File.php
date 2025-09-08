<?php

namespace Src\Services;

use Src\Exceptions\FileException;

class File
{
    public static function checkFileName(string $fileFullName): string
    {
        if (file_exists($fileFullName)) {
            $pathInfo = pathinfo($fileFullName);
            $fileFullName = $pathInfo['dirname'].'/'.$pathInfo['filename'].'(1)'.'.'.$pathInfo['extension'];
            $fileFullName = self::checkFileName($fileFullName);
        }
        return $fileFullName;
    }
}