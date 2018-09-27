<?php

namespace Src\Decorators;

use Src\Interfaces\DataProvider;

/**
 * Base decorator for any data provider
 */
abstract class BaseDataProviderDecorator implements DataProvider
{

    /**
     * @var DataProvider
     */
    protected $dataProvider;


    public function __construct(DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function get(array $request)
    {
        $this->dataProvider->get($request);
    }
}