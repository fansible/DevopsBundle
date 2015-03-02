<?php

namespace Fansible\DevopsBundle\Config;

use Fansible\DevopsBundle\Helper\ServiceHelper;

class AnsibleConfig
{
    /**
     * @var ServiceHelper
     */
    private $serviceHelper;

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
        ServiceHelper::MYSQL => ['name' => 'ANXS.mysql', 'version' => 'v1.0.3'],
        ServiceHelper::POSTGRESQL => ['name' => 'FAKE.postgresql', 'version' => 'v42'],
        ServiceHelper::NODE => ['name' => 'FAKE.node', 'version' => 'v42'],
    ];

    /**
     * @param ServiceHelper  $serviceHelper
     * @param DatabaseConfig $databaseConfig
     * @param string         $provisioningPath
     */
    public function __construct($serviceHelper, $databaseConfig, $provisioningPath = 'devops/provisioning')
    {
        $this->serviceHelper = $serviceHelper;
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
        return $this->serviceHelper->getServices();
    }
}
