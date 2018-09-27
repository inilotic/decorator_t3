<?php
/**
 * Created by PhpStorm.
 * User: tomarov1-iv
 * Date: 27.09.2018
 * Time: 15:35
 */

namespace src\integration;


use src\interfaces\DataProvider;

/**
 * Base realisation for some outer resource calls
 */
class SomeOuterDataProvider implements DataProvider
{

    private $host;
    private $user;
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function get(array $request)
    {
        // returns a response from external service
    }
}