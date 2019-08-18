<?php

namespace Component\Logger;

/**
 * Минимальный набор требований к логгеру
 *
 * Interface BaseLoggerInterface
 * @package Component\Logger
 */
interface BaseLoggerInterface
{
    /**
     * @param $level
     * @param $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = []);
}
