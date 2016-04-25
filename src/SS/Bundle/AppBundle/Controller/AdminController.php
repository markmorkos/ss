<?php
namespace SS\Bundle\AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\SecurityExtraBundle\Annotation\PreAuthorize;
use SS\Bundle\AppBundle\Entity\Page;

/**
 * @Route("/admin")
 * @PreAuthorize("hasRole('ROLE_ADMIN')")
 */
class AdminController
{

    /**
     * @var EntityManagerInterface
     * @DI\Inject("doctrine.orm.entity_manager")
     */
    private $em;

    /**
     * @Rest\Get("/", name="admin_dashboard")
     * @Rest\Get("/pages")
     * @Rest\View()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Rest\Get("/api/{item}.json", name="ss_admin_item", defaults={"_format": "json"})
     * @Rest\View()
     * @param Page $item
     * @return Page
     */
    public function itemAction(Page $item = null)
    {
        return $item;
    }

}