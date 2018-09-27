<?php

namespace Src\Interfaces;

/**
 * Base interface for data providers
 */
interface DataProvider
{
    /**
     * @param array $request
     *
     * @return array
     */
    public function get(array $request);
}