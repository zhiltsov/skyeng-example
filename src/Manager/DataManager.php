<?php

namespace Manager;

use Component\Data\DataInterface;
use Component\Data\DataItem;
use Component\Cache\CacheItem;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;

/**
 * Менеджер работы с X-типом сервисов
 *
 * Class DataManager
 * @package Manager
 */
final class DataManager
{
    /** @var DataInterface */
    private $provider;

    /** @var CacheItemPoolInterface */
    private $cache;

    /** @var LoggerInterface */
    private $logger;

    /**
     * @param DataInterface $provider
     * @param CacheItemPoolInterface $cache
     * @param LoggerInterface $logger
     */
    public function __construct(DataInterface $provider, CacheItemPoolInterface $cache, LoggerInterface $logger)
    {
        $this->provider = $provider;
        $this->cache = $cache;
        $this->logger = $logger;
    }

    /**
     * Формирование запроса и получение данных
     *
     * @param array $input
     * @return DataItem|null
     */
    public function getResponse(array $input)
    {
        try {
            $cacheKey = $this->getCacheKey($input);
            try {
                $cacheItem = $this->cache->getItem($cacheKey);
                if ($cacheItem && $cacheItem->isHit()) {
                    return $cacheItem->get();
                }
            } catch (InvalidArgumentException $e) {
                $this->logger->warning('Error in logic, cache not used');
            };

            $result = $this->provider->get($input);

            $cacheItem = (new CacheItem($cacheKey))
                ->set($result)
                ->expiresAt(
                    (new \DateTime())->modify('+1 day')
                );
            $this->cache->save($cacheItem);

            return $result;
        } catch (\HttpException $e) {
            $this->logger->warning(
                sprintf(
                    'Error provider %s: %s',
                    get_class($this->provider),
                    $e->getMessage()
                )
            );
        } catch (\Exception $e) {
            $this->logger->critical(
                sprintf(
                    'Critical error provider %s: %s',
                    get_class($this->provider),
                    $e->getMessage()
                )
            );
        }

        return null;
    }

    /**
     * Формирование ключа кеша
     *
     * @param array $input
     * @return string
     */
    private function getCacheKey(array $input)
    {
        return md5(json_encode($input));
    }
}
