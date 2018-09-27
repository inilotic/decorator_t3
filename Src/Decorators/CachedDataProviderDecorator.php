<?php

namespace Src\Decorators;


use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Src\Decorators\BaseDataProviderDecorator;
use Src\Interfaces\DataProvider;

class CachedDataProviderDecorator extends BaseDataProviderDecorator
{

    public $cache;
    public $logger;

    /**
     * @param DataProvider $dataProvider
     * @param CacheItemPoolInterface $cache
     * @internal param string $host
     * @internal param string $user
     * @internal param string $password
     */
    public function __construct(DataProvider $dataProvider, CacheItemPoolInterface $cache, LoggerInterface $logger)
    {
        parent::__construct($dataProvider);
        $this->cache = $cache;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */g
    public function get(array $request)
    {
        try {
            $cacheKey = $this->getCacheKey($request);
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $result = $this->dataProvider->get($request);

            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );

            return $result;
        } catch (Exception $e) {
            $this->logger->critical('Error');
        }

        return [];

    }

    public function getCacheKey(array $input)
    {
        return sha1(json_encode($input));
    }

}