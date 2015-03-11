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

        $container->setParameter('fansible_devops.data.name', $config['name']);
        $container->setParameter('fansible_devops.data.timezone', $config['timezone']);
        $container->setParameter('fansible_devops.data.provisioning', $config['provisioning']);
        $container->setParameter('fansible_devops.data.provisioning_path', $config['provisioning_path']);
        $container->setParameter('fansible_devops.data.database', $config['database']);
        $container->setParameter('fansible_devops.data.webserver', $config['webserver']);
        $container->setParameter('fansible_devops.data.vagrant', $config['vagrant']);
        $container->setParameter('fansible_devops.data.environments', $config['environments']);
        $container->setParameter('fansible_devops.data.ansible_roles', $config['ansible_roles']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('config.xml');
        $loader->load('finder.xml');
        $loader->load('generator.xml');
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
}
