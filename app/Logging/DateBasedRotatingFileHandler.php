<?php

namespace App\Logging;

use Monolog\Handler\RotatingFileHandler;

class DateBasedRotatingFileHandler extends RotatingFileHandler
{
    // protected function getTimedFilename()
    // {
    //     return $this->filename . '.' . date('Y-m-d');
    // }
    protected function rotatedFile()
    {
        return $this->filename . '.' . date('Y-m-d');
    }
}
