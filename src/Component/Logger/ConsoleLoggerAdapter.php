<?php

namespace Component\Logger;

/**
 * Вывод лога в консоль
 *
 * Class ConsoleLog
 * @package Component\Logger
 */
class ConsoleLoggerAdapter implements BaseLoggerInterface
{
    /**
     * @param $level
     * @param $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        printf(
            'LOG - %s: %s' . PHP_EOL,
            strtoupper($level),
            $message
        );
    }
}
