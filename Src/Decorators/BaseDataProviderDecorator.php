<?php
/**
 * Created by PhpStorm.
 * User: tomarov1-iv
 * Date: 27.09.2018
 * Time: 15:40
 */

namespace src\decorators;

use src\interfaces\DataProvider;

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