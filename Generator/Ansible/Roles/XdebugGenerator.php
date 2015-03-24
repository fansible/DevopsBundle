<?php

namespace Fansible\DevopsBundle\Generator\Ansible\Roles;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Fansible\DevopsBundle\Generator\Helper\AnsibleRoleHelper;

class XdebugGenerator extends AnsibleRoleHelper
{
    /**
     * @inheritdoc
     */
    public function getService()
    {
        return ServicesConfig::XDEBUG;
    }
}
