<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            // admin_dashboard
            if (rtrim($pathinfo, '/') === '/admin') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_dashboard;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_dashboard');
                }

                return array (  '_controller' => 'SS\\Bundle\\AppBundle\\Controller\\AdminController::indexAction',  '_route' => 'admin_dashboard',);
            }
            not_admin_dashboard:

            // ss_app_admin_index
            if ($pathinfo === '/admin/pages') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_ss_app_admin_index;
                }

                return array (  '_controller' => 'SS\\Bundle\\AppBundle\\Controller\\AdminController::indexAction',  '_route' => 'ss_app_admin_index',);
            }
            not_ss_app_admin_index:

            // ss_admin_item
            if (0 === strpos($pathinfo, '/admin/api') && preg_match('#^/admin/api/(?P<item>[^/\\.]++)\\.json$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_ss_admin_item;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'ss_admin_item')), array (  '_format' => 'json',  'item' => NULL,  '_controller' => 'SS\\Bundle\\AppBundle\\Controller\\AdminController::itemAction',));
            }
            not_ss_admin_item:

        }

        // login_form
        if ($pathinfo === '/login') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_login_form;
            }

            return array (  '_controller' => 'SS\\Bundle\\AppBundle\\Controller\\IndexController::loginAction',  '_route' => 'login_form',);
        }
        not_login_form:

        // index
        if (rtrim($pathinfo, '/') === '') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_index;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'index');
            }

            return array (  '_controller' => 'SS\\Bundle\\AppBundle\\Controller\\IndexController::indexAction',  '_route' => 'index',);
        }
        not_index:

        // pages_list
        if ($pathinfo === '/list') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pages_list;
            }

            return array (  '_format' => 'json',  '_controller' => 'SS\\Bundle\\AppBundle\\Controller\\IndexController::getPagesAction',  '_route' => 'pages_list',);
        }
        not_pages_list:

        // images_list
        if (0 === strpos($pathinfo, '/images/list') && preg_match('#^/images/list/(?P<diskr>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_images_list;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'images_list')), array (  '_format' => 'json',  '_controller' => 'SS\\Bundle\\AppBundle\\Controller\\IndexController::getImagesAction',));
        }
        not_images_list:

        if (0 === strpos($pathinfo, '/cms')) {
            // werkint_cms_core_admin_index
            if ($pathinfo === '/cms/admin') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_werkint_cms_core_admin_index;
                }

                return array (  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::indexAction',  '_route' => 'werkint_cms_core_admin_index',);
            }
            not_werkint_cms_core_admin_index:

            if (0 === strpos($pathinfo, '/cms/list')) {
                // werkint_cms_core_admin_list_root
                if ($pathinfo === '/cms/list') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_werkint_cms_core_admin_list_root;
                    }

                    return array (  'parent' => -1,  '_format' => 'json',  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::listAction',  '_route' => 'werkint_cms_core_admin_list_root',);
                }
                not_werkint_cms_core_admin_list_root:

                // werkint_cms_core_admin_list
                if (preg_match('#^/cms/list(?:/(?P<parent>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_werkint_cms_core_admin_list;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_list')), array (  'parent' => -1,  '_format' => 'json',  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::listAction',));
                }
                not_werkint_cms_core_admin_list:

            }

        }

        if (0 === strpos($pathinfo, '/api')) {
            // werkint_cms_core_admin_item
            if (preg_match('#^/api/(?P<item>[^/\\.]++)\\.json$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_werkint_cms_core_admin_item;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_item')), array (  '_format' => 'json',  'item' => NULL,  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::itemAction',));
            }
            not_werkint_cms_core_admin_item:

            // werkint_cms_core_admin_change
            if (preg_match('#^/api/(?P<item>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_werkint_cms_core_admin_change;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_change')), array (  '_format' => 'json',  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::changeAction',));
            }
            not_werkint_cms_core_admin_change:

            // werkint_cms_core_admin_remove
            if (preg_match('#^/api/(?P<item>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_werkint_cms_core_admin_remove;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_remove')), array (  '_format' => 'json',  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::removeAction',));
            }
            not_werkint_cms_core_admin_remove:

        }

        if (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/create')) {
                if (0 === strpos($pathinfo, '/createblock')) {
                    // werkint_cms_core_admin_block_create
                    if (preg_match('#^/createblock(?:/(?P<parent>[^/]++))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_werkint_cms_core_admin_block_create;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_block_create')), array (  '_format' => 'json',  'parent' => NULL,  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::createBlockAction',));
                    }
                    not_werkint_cms_core_admin_block_create:

                    // werkint_cms_core_admin_saveblock
                    if (preg_match('#^/createblock(?:/(?P<parent>[^/]++))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_werkint_cms_core_admin_saveblock;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_saveblock')), array (  '_format' => 'json',  'parent' => NULL,  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::saveBlockAction',));
                    }
                    not_werkint_cms_core_admin_saveblock:

                }

                if (0 === strpos($pathinfo, '/createfolder')) {
                    // werkint_cms_core_admin_folder_create
                    if (preg_match('#^/createfolder(?:/(?P<parent>[^/]++))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_werkint_cms_core_admin_folder_create;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_folder_create')), array (  '_format' => 'json',  'parent' => NULL,  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::createFolderAction',));
                    }
                    not_werkint_cms_core_admin_folder_create:

                    // werkint_cms_core_admin_savefolder
                    if (preg_match('#^/createfolder(?:/(?P<parent>[^/]++))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_werkint_cms_core_admin_savefolder;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_admin_savefolder')), array (  '_format' => 'json',  'parent' => NULL,  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\AdminController::saveFolderAction',));
                    }
                    not_werkint_cms_core_admin_savefolder:

                }

            }

            // werkint_cms_core_render_article
            if (0 === strpos($pathinfo, '/cms/render') && preg_match('#^/cms/render/(?P<item>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_werkint_cms_core_render_article;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'werkint_cms_core_render_article')), array (  '_controller' => 'Werkint\\Cms\\CoreBundle\\Controller\\ArticleController::indexAction',));
            }
            not_werkint_cms_core_render_article:

        }

        // fos_js_routing_js
        if (0 === strpos($pathinfo, '/js/routing') && preg_match('#^/js/routing(?:\\.(?P<_format>js|json))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_js_routing_js')), array (  '_controller' => 'fos_js_routing.controller:indexAction',  '_format' => 'js',));
        }

        // bazinga_jstranslation_js
        if (0 === strpos($pathinfo, '/translations') && preg_match('#^/translations(?:/(?P<domain>[\\w]+)(?:\\.(?P<_format>js|json))?)?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_bazinga_jstranslation_js;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'bazinga_jstranslation_js')), array (  '_controller' => 'bazinga.jstranslation.controller:getTranslationsAction',  'domain' => 'messages',  '_format' => 'js',));
        }
        not_bazinga_jstranslation_js:

        if (0 === strpos($pathinfo, '/log')) {
            // login_check
            if ($pathinfo === '/login_check') {
                return array('_route' => 'login_check');
            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        if (0 === strpos($pathinfo, '/_uploader')) {
            if (0 === strpos($pathinfo, '/_uploader/cms')) {
                // _uploader_progress_cms
                if ($pathinfo === '/_uploader/cms/progress') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_progress_cms;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.cms:progress',  '_format' => 'json',  '_route' => '_uploader_progress_cms',);
                }
                not__uploader_progress_cms:

                // _uploader_upload_cms
                if ($pathinfo === '/_uploader/cms/upload') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_upload_cms;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.cms:upload',  '_format' => 'json',  '_route' => '_uploader_upload_cms',);
                }
                not__uploader_upload_cms:

            }

            if (0 === strpos($pathinfo, '/_uploader/projects')) {
                // _uploader_progress_projects
                if ($pathinfo === '/_uploader/projects/progress') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_progress_projects;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.projects:progress',  '_format' => 'json',  '_route' => '_uploader_progress_projects',);
                }
                not__uploader_progress_projects:

                // _uploader_upload_projects
                if ($pathinfo === '/_uploader/projects/upload') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_upload_projects;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.projects:upload',  '_format' => 'json',  '_route' => '_uploader_upload_projects',);
                }
                not__uploader_upload_projects:

            }

            if (0 === strpos($pathinfo, '/_uploader/journals')) {
                // _uploader_progress_journals
                if ($pathinfo === '/_uploader/journals/progress') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_progress_journals;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.journals:progress',  '_format' => 'json',  '_route' => '_uploader_progress_journals',);
                }
                not__uploader_progress_journals:

                // _uploader_upload_journals
                if ($pathinfo === '/_uploader/journals/upload') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_upload_journals;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.journals:upload',  '_format' => 'json',  '_route' => '_uploader_upload_journals',);
                }
                not__uploader_upload_journals:

            }

            if (0 === strpos($pathinfo, '/_uploader/slider')) {
                // _uploader_progress_slider
                if ($pathinfo === '/_uploader/slider/progress') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_progress_slider;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.slider:progress',  '_format' => 'json',  '_route' => '_uploader_progress_slider',);
                }
                not__uploader_progress_slider:

                // _uploader_upload_slider
                if ($pathinfo === '/_uploader/slider/upload') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_upload_slider;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.slider:upload',  '_format' => 'json',  '_route' => '_uploader_upload_slider',);
                }
                not__uploader_upload_slider:

            }

            if (0 === strpos($pathinfo, '/_uploader/p_mini')) {
                // _uploader_progress_p_mini
                if ($pathinfo === '/_uploader/p_mini/progress') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_progress_p_mini;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.p_mini:progress',  '_format' => 'json',  '_route' => '_uploader_progress_p_mini',);
                }
                not__uploader_progress_p_mini:

                // _uploader_upload_p_mini
                if ($pathinfo === '/_uploader/p_mini/upload') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_upload_p_mini;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.p_mini:upload',  '_format' => 'json',  '_route' => '_uploader_upload_p_mini',);
                }
                not__uploader_upload_p_mini:

            }

            if (0 === strpos($pathinfo, '/_uploader/j_mini')) {
                // _uploader_progress_j_mini
                if ($pathinfo === '/_uploader/j_mini/progress') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_progress_j_mini;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.j_mini:progress',  '_format' => 'json',  '_route' => '_uploader_progress_j_mini',);
                }
                not__uploader_progress_j_mini:

                // _uploader_upload_j_mini
                if ($pathinfo === '/_uploader/j_mini/upload') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not__uploader_upload_j_mini;
                    }

                    return array (  '_controller' => 'oneup_uploader.controller.j_mini:upload',  '_format' => 'json',  '_route' => '_uploader_upload_j_mini',);
                }
                not__uploader_upload_j_mini:

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
