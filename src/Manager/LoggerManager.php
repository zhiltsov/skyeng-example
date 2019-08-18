<?php

namespace Manager;

use Component\Logger\BaseLoggerInterface;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Менеджер ведения логов
 *
 * Class LoggerManager
 * @package Manager
 */
final class LoggerManager extends AbstractLogger
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = [])
    {
        $this->logger->log($level, $message, $context);
    }

    /**
     * LoggerManager constructor.
     * @param BaseLoggerInterface $logger
     */
    public function __construct(BaseLoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
