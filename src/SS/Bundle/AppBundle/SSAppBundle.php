<?php

namespace SS\Bundle\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * SSAppBundle
 *
 * @author Kate Shcherbak <katescherbak@gmail.com>
 */
class SSAppBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
