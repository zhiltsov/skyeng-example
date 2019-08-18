<?php

use Component\Cache\NullCachePool;
use Component\Data\DataProvider;
use Component\Logger\ConsoleLoggerAdapter;
use Manager\CacheManager;
use Manager\DataManager;
use Manager\LoggerManager;

require_once __DIR__ . '/vendor/autoload.php';

$cacheManager = new CacheManager(new NullCachePool());

$loggerManager = new LoggerManager(new ConsoleLoggerAdapter());

$dataConfig = [
    'host' => 'http://md5.jsontest.com',
    'user' => '',
    'password' => ''
];

$manager = new DataManager(
    new DataProvider(...array_values($dataConfig)),
    $cacheManager,
    $loggerManager
);

$item = $manager->getResponse(['text' => 'Hello, SkyEng!']);

echo $item ? $item->toString() : 'Oh... :(';
