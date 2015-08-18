<?php namespace SpamScore;


use GuzzleHttp\ClientInterface;

/**
 * Class GatewayFactory
 * @package SpamScore
 */
class GatewayFactory
{

    /**
     * The package namespace
     */
    const PACKAGE_NAMESPACE = 'SpamScore';

    /**
     * @param string $class the provider name
     * @param ClientInterface|null $httpClient
     * @return mixed
     */
    public function create($class, ClientInterface $httpClient = null)
    {

        $class = static::getGatewayClassName($class);
        if ( ! class_exists($class)) {
            throw new \RuntimeException("Class '$class' not found");
        }

        return new $class($httpClient);
    }

    /**
     * Build the gateway name from the provider key
     *
     * @param $shortName
     * @return string
     */
    public static function getGatewayClassName($shortName)
    {

        $shortName = str_replace('_', '\\', $shortName);

        return sprintf("\\%s\\Providers\\%s\\Gateway", static::PACKAGE_NAMESPACE, rtrim($shortName, '\\'));
    }
}
