<?php

namespace Fansible\DevopsBundle\Generator\Ansible\Roles;

use Fansible\DevopsBundle\Generator\Helper\GeneratorInterface;

class MysqlGenerator implements GeneratorInterface
{
    /**
     * @var \Fansible\DevopsBundle\Config\AnsibleConfig
     */
    private $config;

    /**
     * @var \Fansible\DevopsBundle\Generator\Helper\TwigHelper
     */
    private $twigHelper;

    /**
     * @param \Fansible\DevopsBundle\Config\AnsibleConfig        $config
     * @param \Fansible\DevopsBundle\Generator\Helper\TwigHelper $twigHelper
     */
    public function __construct($config, $twigHelper)
    {
        $this->config = $config;
        $this->twigHelper = $twigHelper;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $this->twigHelper->render(
            $this->config->getProvisioningPath() . '/vars/mysql.yml',
            'Ansible/Roles/mysql.yml.twig',
            [
                'database' => $this->config->getDatabaseConfig(),
            ]
        );
    }
}
