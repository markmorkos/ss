<?php
namespace SS\Bundle\AppBundle\Service\Twig;

use SS\Bundle\AppBundle\Entity\Image;
use SS\Bundle\AppBundle\Service\Util\FileUrlManager;
use Werkint\Bundle\FrameworkExtraBundle\Twig\AbstractExtension;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Vladimir Odesskij <odesskij1992@gmail.com>
 */
class SSAppExtension extends AbstractExtension
{
    /**
     * @var
     */
    private $parameters;
    protected $request;
    protected $fileUrlManager;
    protected $globals;

    const EXT_NAME = 'SS_app';

    /**
     * @param                       $parameters
     * @param FileUrlManager        $fileUrlManager
     * @param TokenStorageInterface $security
     * @throws \Exception
     * @internal param $globals
     */
    public function __construct(
        $parameters,
        FileUrlManager $fileUrlManager,
        TokenStorageInterface $security
    ) {
        $this->parameters = $parameters;
        $this->fileUrlManager = $fileUrlManager;
        $this->security = $security;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        $this->addFunction(
            'file_url',
            false,
            function ($file = null) {
                if (!$file || !$file instanceof Image) { //TODO: костыль из-за твига
                    return null;
                }
                return $this->fileUrlManager->getUrl($file);
            }
        );
        $this->addFunction(
            'file_path_full',
            false,
            function ($file = null) {
                if (!$file || !$file instanceof Image) { //TODO: костыль из-за твига
                    return null;
                }
                return $this->request->getUriForPath($this->fileUrlManager->getUrl($file));
            }
        );

        $this->addFilter(
            'console',
            true,
            function () {
                return join(
                    '',
                    array_map(
                        function ($argument) {
                            return '<script>console.log(' . json_encode($argument) . ');</script>';
                        },
                        func_get_args()
                    )
                );
            }
        );

        $this->addFilter(
            'formattedMoney',
            true,
            function () {
                return '';
            }
        );
        $this->addFilter(
            'localizeddate',
            true,
            function () {
                return '';
            }
        );

        $lastId = null;
        $called = 0;
        $this->addFunction(
            'id',
            false,
            function () use (&$lastId, &$called) {
                if ((++$called) % 2 === 1) {
                    $lastId = substr(md5(mt_rand(0, 10000)), 0, 15);
                }
                return $lastId;
            }
        );
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return $this->parameters['globals'];
    }
}
