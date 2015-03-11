<?php

namespace Fansible\DevopsBundle\Generator\Ansible\Roles;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class MysqlGenerator implements GeneratorInterface
{
    /**
     * @var \Fansible\DevopsBundle\Generator\Helper\TwigHelper
     */
    private $twigHelper;

    /**
     * @var ServicesConfig
     */
    private $servicesConfig;

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
        $this->twigHelper = $twigHelper;
        $this->servicesConfig = $servicesConfig;
        $this->databaseConfig = $databaseConfig;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        if ($this->servicesConfig->isPresent(ServicesConfig::ANSIBLE)
            && $this->servicesConfig->isPresent(ServicesConfig::MYSQL)
        ) {
            $this->twigHelper->renderProvisioningFile(
                'vars/mysql.yml',
                'Ansible/Roles:mysql.yml.twig',
                [
                    'database' => $this->databaseConfig,
                ]
            );
        }
    }
}
