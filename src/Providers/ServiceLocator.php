<?php

namespace App\Providers;

use App\Exceptions\UndefinedServiceException;

class ServiceLocator
{
    /**
     * @var array
     */
    private static array $services = [];

    /**
     * Add specific service by its alias
     *
     * @param string $serviceName
     * @param $serviceInstance
     * @return void
     */
    public static function add(string $serviceName, $serviceInstance): void
    {
        if (!isset(self::$services[$serviceName])) {
            self::$services[$serviceName] = $serviceInstance;
        }
    }

    /**
     * @throws UndefinedServiceException
     */
    public static function get(string $serviceName)
    {
        if (!isset(self::$services[$serviceName])) {
            throw new UndefinedServiceException(sprintf('No instance for service [%s] ', $serviceName));
        }
        return self::$services[$serviceName];
    }
}