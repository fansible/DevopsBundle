<?php

namespace Fansible\DevopsBundle\Generator\Ansible\Roles;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\AnsibleRoleHelper;

class NodeGenerator extends AnsibleRoleHelper
{
    /**
     * @inheritdoc
     */
    public function getService()
    {
        return ServicesConfig::NODE;
    }
}
