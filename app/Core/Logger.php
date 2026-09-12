<?php
namespace App\Core;

class Logger
{
    public static function error(string $message): void
    {
        $logFile = __DIR__ . '/../../storage/logs/app.log';
        $timestamp = date('Y-m-d H:i:s');
        $line = "{$timestamp} - {$message}" . PHP_EOL;

        error_log($line, 3, $logFile);
    }
}