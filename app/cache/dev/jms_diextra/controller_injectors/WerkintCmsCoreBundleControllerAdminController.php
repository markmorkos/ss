<?php

namespace Werkint\Cms\CoreBundle\Controller;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class AdminController__JMSInjector
{
    public static function inject($container) {
        $instance = new \Werkint\Cms\CoreBundle\Controller\AdminController();
        $refProperty = new \ReflectionProperty('Werkint\\Cms\\CoreBundle\\Controller\\AdminController', 'repoItem');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('werkint_cms_core.repo.item', 1));
        $refProperty = new \ReflectionProperty('Werkint\\Cms\\CoreBundle\\Controller\\AdminController', 'em');
        $refProperty->setAccessible(true);
        $refProperty->setValue($instance, $container->get('doctrine.orm.entity_manager', 1));
        return $instance;
    }
}
