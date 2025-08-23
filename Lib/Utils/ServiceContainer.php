<?php


namespace Utils;


class ServiceContainer
{

    protected array $services = [];

    public function setService(string $service, object $func): void
    {
        $this->services[$service] = $func;
    }

    /**
     * @throws \Exception
     */
    public function getService($service)
    {
        if (!isset($this->services[$service])) {
            throw new \Exception("Not found service {$service}");
        }
        return call_user_func($this->services[$service]);
    }

}