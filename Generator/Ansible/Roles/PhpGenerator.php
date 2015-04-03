<?php

namespace Fansible\DevopsBundle\Generator\Ansible\Roles;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\AnsibleRoleHelper;

class PhpGenerator extends AnsibleRoleHelper
{
    /**
     * @inheritdoc
     */
    public function getService()
    {
        return ServicesConfig::PHP;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return [
            'services' => $this->servicesConfig
        ];
    }
}
