<?php

namespace src\interfaces;

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