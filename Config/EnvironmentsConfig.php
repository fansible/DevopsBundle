<?php

namespace Fansible\DevopsBundle\Config;

class EnvironmentsConfig
{
    /**
     * @var array
     */
    private $environments;

    public function __construct(array $environments)
    {
        foreach ($environments as $name => $config) {
            $this->environments[] = new EnvironmentConfig($name, $config);
        }
    }

    /**
     * @return array
     */
    public function getEnvironments()
    {
        return $this->environments;
    }
}
