<?php
namespace {
    use SS\Model\AppKernel;
    use Symfony\Bundle\FrameworkBundle\Console\Application;
    use Symfony\Component\Console\Input\ArgvInput;
    use Symfony\Component\Debug\Debug;

    set_time_limit(0);
    define('SYMFONY_ROOT', realpath(__DIR__ . '/..'));
    require_once __DIR__ . '/../bootstrap.php.cache';

    $input = new ArgvInput();
    $env = $input->getParameterOption(['--env', '-e'], getenv('SYMFONY_ENV') ?: 'dev');
    define('SYMFONY_ENV', $env);

    // TODO: проверить безопасность
    $debug = SYMFONY_ENV !== 'prod';
    if ($debug) {
        Debug::enable();
    }

    $kernel = new AppKernel(SYMFONY_ENV, explode('_', SYMFONY_ENV)[0] == 'dev');

    $application = new Application($kernel);
    $application->run($input);
}
