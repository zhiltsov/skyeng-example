<?php

namespace Manager;

use Component\Cache\NullCachePool;
use Component\Data\DataInterface;
use Component\Data\DataProvider;
use Component\Logger\BaseLoggerInterface;
use Component\Logger\ConsoleLoggerAdapter;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Test DataManager
 * Class DataManagerTest
 */
final class DataManagerTest extends TestCase
{
    /**
     * @return CacheItemPoolInterface NullCachePool
     */
    public function testCachePool()
    {
        $cache = new NullCachePool();
        $this->assertTrue($cache instanceof CacheItemPoolInterface);

        return $cache;
    }

    /**
     * @return BaseLoggerInterface ConsoleLoggerAdapter
     */
    public function testLoggerAdapter()
    {
        $logger = new ConsoleLoggerAdapter();
        $this->assertTrue($logger instanceof BaseLoggerInterface);

        return $logger;
    }

    /**
     * @return DataInterface DataProvider
     */
    public function testDataProvider()
    {
        $dataConfig = [
            'host' => 'http://md5.jsontest.com',
            'user' => '',
            'password' => ''
        ];

        $provider = new DataProvider(...array_values($dataConfig));
        $this->assertTrue($provider instanceof DataInterface);

        return $provider;
    }

    /**
     * @depends testCachePool
     * @depends testLoggerAdapter
     * @depends testDataProvider
     * @param CacheItemPoolInterface $cache
     * @param BaseLoggerInterface $logger
     * @param DataInterface $provider
     * @return DataManager
     */
    public function test__construct(
        CacheItemPoolInterface $cache,
        BaseLoggerInterface $logger,
        DataInterface $provider
    ) {
        $manager = null;
        $throwCount = 0;

        try {
            $cacheManager = new CacheManager($cache);
            $loggerManager = new LoggerManager($logger);
            $manager = new DataManager($provider, $cacheManager, $loggerManager);
        } catch (\Exception $e) {
            $throwCount++;
        }

        $this->assertEquals($throwCount, 0);

        return $manager;
    }

    /**
     * @dataProvider additionProvider
     * @depends      test__construct
     * @param DataManager $manager
     * @param string $text
     */
    public function testGetResponse($text, DataManager $manager)
    {
        $item = $manager->getResponse(['text' => $text]);

        $this->assertNotNull($item);
        $this->assertNotNull($item->getOriginal());
        $this->assertIsString($item->getOriginal());
        $this->assertNotNull($item->getMd5());
        $this->assertIsString($item->getMd5());
        $this->assertEquals(md5($item->getOriginal()), $item->getMd5());
    }

    public function additionProvider()
    {
        return [
            ['Hello, SkyEng!'],
            ['Hi, SkyEng!'],
            ['Lol, SkyEng!'],
            ['Test, SkyEng!'],
        ];
    }
}
