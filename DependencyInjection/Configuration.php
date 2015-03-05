<?php

namespace Fansible\DevopsBundle\DependencyInjection;

use Fansible\DevopsBundle\Config\ServicesConfig;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fansible_devops');

        $rootNode
            ->children()
                ->scalarNode('name')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('provisioning')
                    ->defaultValue(ServicesConfig::ANSIBLE)
                    ->validate()
                    ->ifNotInArray(array(ServicesConfig::ANSIBLE, ServicesConfig::DOCKER))
                        ->thenInvalid('Invalid webserver %s')
                    ->end()
                ->end()
                ->scalarNode('provisioning_path')->defaultValue('devops/provisioning/')->end()
                ->arrayNode('webserver')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('service')
                            ->defaultValue(ServicesConfig::APACHE)
                            ->validate()
                            ->ifNotInArray(array(ServicesConfig::APACHE, ServicesConfig::NGINX))
                                ->thenInvalid('Invalid webserver service %s')
                            ->end()
                        ->end()
                        ->integerNode('port')->defaultValue(80)->min(0)->max(65535)->end()
                    ->end()
                ->end()
                ->arrayNode('database')
                    ->children()
                        ->scalarNode('driver')->defaultNull()->end()
                        ->scalarNode('name')->defaultNull()->end()
                        ->scalarNode('user')->defaultNull()->end()
                        ->scalarNode('password')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('vagrant')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('box')->defaultValue('ubuntu/trusty64')->end()
                        ->scalarNode('ip')->defaultValue('8.0.0.8')->end()
                        ->scalarNode('memory')->defaultValue('1024')->end()
                        ->scalarNode('cpus')->defaultValue('1')->end()
                        ->scalarNode('exec')->defaultValue('100')->end()
                        ->scalarNode('src')->defaultValue('.')->end()
                        ->scalarNode('dest')->defaultNull()->end()
                        ->scalarNode('hostfile')->defaultValue('devops/privisioning/inventory/vagrant')->end()
                    ->end()
                ->end()
                ->arrayNode('environments')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('ip')->end()
                            ->scalarNode('host')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('ansible_roles')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->end()
                            ->scalarNode('version')->end()
                            ->scalarNode('template')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
