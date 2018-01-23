<?php

namespace Moskalyovd\FDLBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('moskalyovd_fdl');

        $rootNode
            ->children()
                ->scalarNode('api_key')->cannotBeEmpty()->end()
                ->scalarNode('domain')->cannotBeEmpty()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
