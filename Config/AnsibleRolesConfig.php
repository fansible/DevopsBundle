<?php

namespace Fansible\DevopsBundle\Config;

class AnsibleRolesConfig
{
    private $rolesSupported = [
        ServicesConfig::PHP,
        ServicesConfig::COMPOSER,
        ServicesConfig::MYSQL,
        ServicesConfig::POSTGRESQL,
        ServicesConfig::APACHE,
        ServicesConfig::NGINX,
        ServicesConfig::NODE,
        ServicesConfig::XDEBUG,
    ];

    /**
     * @var array
     */
    private $roles = [
        // base
        ServicesConfig::APT => ['name' => 'kosssi.apt', 'version' => 'v2.0.0'],
        ServicesConfig::PHP => ['name' => 'kosssi.php', 'version' => 'v1.1.0'],
        ServicesConfig::COMPOSER => ['name' => 'kosssi.composer', 'version' => 'v1.2.0'],
        // database
        ServicesConfig::MYSQL => ['name' => 'ANXS.mysql', 'version' => 'v1.0.3'],
        ServicesConfig::POSTGRESQL => ['name' => 'ANXS.postgresql', 'version' => 'v1.1.0'],
        // webserver
        ServicesConfig::APACHE => ['name' => 'kosssi.apache', 'version' => 'v1.0.3'],
        ServicesConfig::NGINX => ['name' => 'nginx-symfony', 'version' => 'none'],

        ServicesConfig::NODE => ['name' => 'Stouts.nodejs', 'version' => '1.1.2'],
        ServicesConfig::XDEBUG => ['name' => 'MaximeThoonsen.php5-xdebug', 'version' => 'v1.0.5'],
    ];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        foreach ($config as $service => $role) {
            if (in_array($service, $this->rolesSupported)) {
                foreach ($role as $key => $value) {
                    $this->roles[$service][$key] = $value;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string $service
     *
     * @return array
     */
    public function getRole($service)
    {
        return $this->roles[$service];
    }
}
