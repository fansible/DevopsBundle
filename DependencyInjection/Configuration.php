<?php

namespace Fansible\DevopsBundle\DependencyInjection;

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
                ->arrayNode('webserver')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')->defaultNull()->end()
                        ->scalarNode('hostname')->defaultNull()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
