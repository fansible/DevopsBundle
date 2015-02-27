<?php

namespace Fansible\DevopsBundle\Config;

use Fansible\DevopsBundle\Services;

class AnsibleConfig
{
    /**
     * @var \Fansible\DevopsBundle\Finder\Helper\FinderContainer
     */
    private $finderContainer;

    /**
     * @var DatabaseConfig
     */
    private $databaseConfig;

    /**
     * @var string
     */
    private $provisioningPath;

    /**
     * @var array
     */
    private $roles = [
        Services::MYSQL => ['name' => 'ANXS.mysql', 'version' => 'v1.0.3'],
        Services::POSTGRESQL => ['name' => 'FAKE.node', 'version' => 'v42'],
        Services::NODE => ['name' => 'FAKE.node', 'version' => 'v42'],
    ];

    /**
     * @param \Fansible\DevopsBundle\Finder\Helper\FinderContainer $finderContainer
     * @param DatabaseConfig $databaseConfig
     * @param string         $provisioningPath
     */
    public function __construct($finderContainer, $databaseConfig, $provisioningPath = 'devops/provisioning')
    {
        $this->finderContainer = $finderContainer;
        $this->databaseConfig = $databaseConfig;
        $this->provisioningPath = $provisioningPath;
    }

    /**
     * @return DatabaseConfig
     */
    public function getDatabaseConfig()
    {
        return $this->databaseConfig;
    }

    /**
     * @return string
     */
    public function getProvisioningPath()
    {
        return $this->provisioningPath;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->finderContainer->getServices();
    }
}
