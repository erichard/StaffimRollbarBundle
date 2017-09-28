<?php

namespace Staffim\RollbarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Vyacheslav Salakhutdinov <megazoll@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('staffim_rollbar');

        $rootNode
            ->children()
                ->scalarNode('environment')
                    ->defaultValue('%kernel.environment%')
                ->end()
                ->scalarNode('access_token')
                ->end()
                ->scalarNode('error_level')
                    ->defaultValue(-1)
                ->end()
                ->booleanNode('notify_http_exception')
                    ->defaultValue(false)
                ->end()
                ->arrayNode('scrub')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('exceptions')
                            ->prototype('scalar')->end()
                            ->treatNullLike(array())
                            ->defaultValue(array())
                        ->end()
                        ->arrayNode('parameters')
                            ->prototype('scalar')->end()
                            ->treatNullLike(array())
                            ->defaultValue(array())
                        ->end()
                    ->end()
                ->end()
                ->booleanNode('enabled')
                    ->defaultValue(true)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
