<?php
namespace SS\Model;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Позволяет шаблонам наследовать базовый класс
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 *
 * @see https://github.com/symfony/symfony/pull/2202
 */
abstract class ExtendedKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function getBundle($name, $first = true)
    {
        $original = false;
        if ('!' === $name[0]) {
            $name = substr($name, 1);
            $original = true;
        }

        if (!isset($this->bundleMap[$name])) {
            throw new \InvalidArgumentException(sprintf('Bundle "%s" does not exist or it is not enabled. Maybe you forgot to add it in the registerBundles() function of your %s.php file?', $name, get_class($this)));
        }

        if (true === $original) {
            $bundle = end($this->bundleMap[$name]);
            return $first ? $bundle : [$bundle];
        }

        if (true === $first) {
            return $this->bundleMap[$name][0];
        }

        return $this->bundleMap[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function locateResource($name, $dir = null, $first = true)
    {
        if ('@' !== $name[0]) {
            throw new \InvalidArgumentException(sprintf('A resource name must start with @ ("%s" given).', $name));
        }

        if (false !== strpos($name, '..')) {
            throw new \RuntimeException(sprintf('File name "%s" contains invalid characters (..).', $name));
        }

        $bundleName = substr($name, 1);
        $path = '';
        if (false !== strpos($bundleName, '/')) {
            list($bundleName, $path) = explode('/', $bundleName, 2);
        }

        $isResource = 0 === strpos($path, 'Resources') && null !== $dir;
        $overridePath = substr($path, 9);
        $resourceBundle = null;
        $bundles = $this->getBundle($bundleName, false);
        $files = [];
        /** @var Bundle[] $bundles */

        foreach ($bundles as $bundle) {
            if ($name[1] !== '!' && $isResource && file_exists($file = $dir . '/' . $bundle->getName() . $overridePath)) {
                if (null !== $resourceBundle) {
                    throw new \RuntimeException(sprintf('"%s" resource is hidden by a resource from the "%s" derived bundle. Create a "%s" file to override the bundle resource.',
                        $file,
                        $resourceBundle,
                        $dir . '/' . $bundles[0]->getName() . $overridePath
                    ));
                }

                if ($first) {
                    return $file;
                }
                $files[] = $file;
            }

            if (file_exists($file = $bundle->getPath() . '/' . $path)) {
                if ($first && !$isResource) {
                    return $file;
                }
                $files[] = $file;
                $resourceBundle = $bundle->getName();
            }
        }

        if (count($files) > 0) {
            return $first && $isResource ? $files[0] : $files;
        }

        throw new \InvalidArgumentException(sprintf('Unable to find file "%s".', $name));
    }
}