<?php

namespace Fansible\DevopsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FansibleDevopsExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->databaseConfig($config['database'], $container);

        // vagrant
        $container->setParameter('fansible_devops.data.vagrant.project_name', $config['name']);
        $container->setParameter('fansible_devops.data.vagrant.box', $config['vagrant']['box']);
        $container->setParameter('fansible_devops.data.vagrant.ip', $config['vagrant']['ip']);
        $container->setParameter('fansible_devops.data.vagrant.memory', $config['vagrant']['memory']);
        $container->setParameter('fansible_devops.data.vagrant.cpus', $config['vagrant']['cpus']);
        $container->setParameter('fansible_devops.data.vagrant.exec', $config['vagrant']['exec']);
        $container->setParameter('fansible_devops.data.vagrant.src', $config['vagrant']['src']);
        $container->setParameter('fansible_devops.data.vagrant.dest', $config['vagrant']['dest'] ? $config['vagrant']['dest'] : '/var/www/' . $config['name'] . '/current');
        $container->setParameter('fansible_devops.data.vagrant.hostfile', $config['vagrant']['hostfile']);

        $container->setParameter('fansible_devops.data.webserver.type', $config['webserver']['type']);
        $container->setParameter('fansible_devops.data.webserver.hostname', $config['webserver']['hostname']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('config.xml');
        $loader->load('finder.xml');
        $loader->load('generator.xml');
        $loader->load('helper.xml');
    }

    public function prepend(ContainerBuilder $container)
    {
        // get all bundles
        $bundles = $container->getParameter('kernel.bundles');
        // determine if DoctrineBundle is registered
        if (isset($bundles['DoctrineBundle'])) {
            $doctrineConfigs = $container->getExtensionConfig('doctrine');
            // check if entity_manager_name is set in the "acme_hello" configuration
            if (isset($doctrineConfigs[0]['dbal'])) {
                // prepend the acme_something settings with the entity_manager_name
                $config = array('database' => $this->databaseFilter($doctrineConfigs[0]['dbal']));
                $container->prependExtensionConfig($this->getAlias(), $config);
            }
        }
    }

    /**
     * @param array $config
     *
     * @return array
     */
    private function databaseFilter(array $config)
    {
        return [
            'driver'   => isset($config['driver'])   ? $config['driver']   : '',
            'name'     => isset($config['dbname'])   ? $config['dbname']   : '',
            'user'     => isset($config['user'])     ? $config['user']     : '',
            'password' => isset($config['password']) ? $config['password'] : '',
        ];
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function databaseConfig(array $config, ContainerBuilder $container)
    {
        $container->setParameter('fansible_devops.data.database.driver',   $config['driver']);
        $container->setParameter('fansible_devops.data.database.name',     $config['name']);
        $container->setParameter('fansible_devops.data.database.user',     $config['user']);
        $container->setParameter('fansible_devops.data.database.password', $config['password']);
    }
}
