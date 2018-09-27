<?php


namespace Src\Integration;


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