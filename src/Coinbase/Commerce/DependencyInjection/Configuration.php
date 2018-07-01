<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/28/18
 * Time: 4:51 PM
 */

namespace App\Coinbase\Commerce\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        /**
         *
        # config/packages/coinbase.yaml
        coinbase_commerce:
            api:
                key: blablabla
                version: 2018-03-22
            webhook:
                secret: blablabla

         *
         */
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('coinbase_commerce');
        $rootNode
            ->children()
                ->arrayNode('api')
                    ->children()
                        ->scalarNode('key')->end()
                        ->scalarNode('version')->end()
                    ->end()
                ->end() //api
                ->arrayNode('webhook')
                    ->children()
                        ->scalarNode('secret')->end()
                    ->end()
                ->end() //webhook
            ->end() //rootNode children
        ;

        return $treeBuilder;
    }
}