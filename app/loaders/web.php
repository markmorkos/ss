<?php
namespace {
    use SS\Model\AppCache;
    use SS\Model\AppKernel;
    use Symfony\Component\ClassLoader\ApcClassLoader;
    use Symfony\Component\Debug\Debug;
    use Symfony\Component\HttpFoundation\Request;

    if (!getenv('SYMFONY_APPNAME')) {
        define('SYMFONY_APPNAME', 'test.o.o');
    } else {
        define('SYMFONY_APPNAME', getenv('SYMFONY_APPNAME'));
    }
    if (!getenv('SYMFONY_ENV')) {
        define('SYMFONY_ENV', 'dev');
    } else {
        define('SYMFONY_ENV', getenv('SYMFONY_ENV'));
    }

    define('SYMFONY_ROOT', realpath(__DIR__ . '/..'));
    require_once __DIR__ . '/../bootstrap.php.cache';

    $kernel = new AppKernel(SYMFONY_ENV, explode('_', SYMFONY_ENV)[0] == 'dev');
    $debug = $kernel->isDebug();

    if (!$debug) {
        $kernel = new AppCache($kernel);
        $loader = new ApcClassLoader(SYMFONY_APPNAME . '_' . SYMFONY_ENV, $loader);
        $loader->register(true);
        $kern = $kernel->getKernel();
        /** @var AppKernel $kern */
        $kern->loadClassCache();
    } elseif ($debug) {
        // TODO: включить всегда
        Debug::enable();
    }

    $request = Request::createFromGlobals();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
}