<?php

namespace Fansible\DevopsBundle\Generator\Ansible\Roles;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\AnsibleRoleHelper;

class PostgresqlGenerator extends AnsibleRoleHelper
{
    /**
     * @var \Fansible\DevopsBundle\Config\DatabaseConfig
     */
    private $databaseConfig;

    /**
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     * @param ServicesConfig                                     $servicesConfig
     * @param \Fansible\DevopsBundle\Config\DatabaseConfig       $databaseConfig
     */
    public function __construct($twigHelper, $servicesConfig, $databaseConfig)
    {
        parent::__construct($twigHelper, $servicesConfig);
        $this->databaseConfig = $databaseConfig;
    }

    /**
     * @inheritdoc
     */
    public function getService()
    {
        return ServicesConfig::POSTGRESQL;
    }

    /**
     * @inheritdoc
     */
    public function getParameters()
    {
        return [
            'database' => $this->databaseConfig,
        ];
    }
}
