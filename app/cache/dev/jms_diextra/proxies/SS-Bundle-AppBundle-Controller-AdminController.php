<?php

namespace EnhancedProxya694449f_7ac88af0f2005aa610088f9d6381c07cd438caff\__CG__\SS\Bundle\AppBundle\Controller;

/**
 * CG library enhanced proxy class.
 *
 * This code was generated automatically by the CG library, manual changes to it
 * will be lost upon next generation.
 */
class AdminController extends \SS\Bundle\AppBundle\Controller\AdminController
{
    private $__CGInterception__loader;

    public function itemAction(\SS\Bundle\AppBundle\Entity\Page $item = NULL)
    {
        $ref = new \ReflectionMethod('SS\\Bundle\\AppBundle\\Controller\\AdminController', 'itemAction');
        $interceptors = $this->__CGInterception__loader->loadInterceptors($ref, $this, array($item));
        $invocation = new \CG\Proxy\MethodInvocation($ref, $this, array($item), $interceptors);

        return $invocation->proceed();
    }

    public function indexAction()
    {
        $ref = new \ReflectionMethod('SS\\Bundle\\AppBundle\\Controller\\AdminController', 'indexAction');
        $interceptors = $this->__CGInterception__loader->loadInterceptors($ref, $this, array());
        $invocation = new \CG\Proxy\MethodInvocation($ref, $this, array(), $interceptors);

        return $invocation->proceed();
    }

    public function __CGInterception__setLoader(\CG\Proxy\InterceptorLoaderInterface $loader)
    {
        $this->__CGInterception__loader = $loader;
    }
}