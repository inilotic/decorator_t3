<?php
/**
 * Created by PhpStorm.
 * User: tomarov1-iv
 * Date: 27.09.2018
 * Time: 15:44
 */

namespace src\integration;


use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\decorators\BaseDataProviderDecorator;
use src\interfaces\DataProvider;

class CachedBaseDataProviderDecorators extends BaseDataProviderDecorator
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
    public function __construct(DataProvider $dataProvider, CacheItemPoolInterface $cache)
    {
        parent::__construct($dataProvider);
        $this->cache = $cache;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
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