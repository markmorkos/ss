<?php
namespace SS\Bundle\AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\DiExtraBundle\Annotation as DI;
use SS\Bundle\AppBundle\Entity\ImageRepository;
use SS\Bundle\AppBundle\Entity\PageRepository;

/**
 * Главный контроллер, в нём ссылки превращаются в HTML
 */
class IndexController
{
    /**
     * @DI\Inject("ss_app.repo.page")
     * @var PageRepository
     */
    private $repoPages;

    /**
     * @DI\Inject("ss_app.repo.image")
     * @var ImageRepository
     */
    private $repoImages;

    /**
     * @Rest\Get("/login", name="login_form")
     * @Rest\View()
     */
    public function loginAction()
    {
        return [];
    }

    // --------  старотовая страница

    /**
     * @Rest\Get("/", name="index")
     * @Rest\View()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Rest\Get("/list", name="pages_list",
     *   defaults={"_format": "json"}
     * )
     * @Rest\View()
     */
    public function getPagesAction()
    {
        return $this->repoPages->getPages();
    }

    /**
     * @Rest\Get("/images/list/{diskr}", name="images_list",
     *   defaults={"_format": "json"}
     * )
     * @Rest\View()
     * @param $diskr
     * @return array
     */
    public function getImagesAction($diskr)
    {
        return $this->repoImages->getByPage($diskr);
    }

}