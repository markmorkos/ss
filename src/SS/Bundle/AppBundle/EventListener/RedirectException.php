<?php

namespace SS\Bundle\AppBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;


/**
 * @author Ekaterina Markova <migraciiushastojsovi@gmail.com>
 */
class RedirectException
{

    /**
     * @param GetResponseForExceptionEvent $event
     */
    function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ($event->getException() instanceof NotFoundHttpException) {
            $response = new RedirectResponse('/');

            $event->setResponse($response);
        }
    }
}