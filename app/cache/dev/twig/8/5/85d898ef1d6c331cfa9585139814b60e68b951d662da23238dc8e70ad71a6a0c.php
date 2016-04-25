<?php

/* SSAppBundle:Index:index.twig */
class __TwigTemplate_85d898ef1d6c331cfa9585139814b60e68b951d662da23238dc8e70ad71a6a0c extends Werkint\Bundle\WebappBundle\Twig\Extension\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@SSApp/layout.twig", "SSAppBundle:Index:index.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@SSApp/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_5328305058e024660463d6fbde7daab0a9cb3a5be5993a8b1d3593e43f0c50fc = $this->env->getExtension("native_profiler");
        $__internal_5328305058e024660463d6fbde7daab0a9cb3a5be5993a8b1d3593e43f0c50fc->enter($__internal_5328305058e024660463d6fbde7daab0a9cb3a5be5993a8b1d3593e43f0c50fc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SSAppBundle:Index:index.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5328305058e024660463d6fbde7daab0a9cb3a5be5993a8b1d3593e43f0c50fc->leave($__internal_5328305058e024660463d6fbde7daab0a9cb3a5be5993a8b1d3593e43f0c50fc_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_2dce80883de4399d72c79a81130fb016ae005967422a7d4c414aab48a05d81e1 = $this->env->getExtension("native_profiler");
        $__internal_2dce80883de4399d72c79a81130fb016ae005967422a7d4c414aab48a05d81e1->enter($__internal_2dce80883de4399d72c79a81130fb016ae005967422a7d4c414aab48a05d81e1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "  <section class=\"promo mainPage\">
    <div class=\"center-holder\">
      <strong class=\"logo\"><img src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/logo.svg"), "html", null, true);
        echo "\"
                                alt=\"SECURITY SCIENCE\"></strong>
    </div>
  </section>
  <main class=\"mainPage\">
    <div class=\"content-tabs\"></div>
    <aside class=\"info-block\">
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"column\">
            <h3>contacts</h3>

            <div class=\"text-holder\">
              <p>Kharkiv, Ukraine</p>
            </div>
            <div class=\"text-holder\">
              <div class=\"cell\">
                <p><a href=\"tel:+380000000000\">+38 (000) 00 00 000</a><br>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </aside>
  </main>
  <footer class=\"main-footer\">
    <div class=\"content\">
      <span class=\"copyright\">© 2016 SECURITY SCIENCE</span>
    </div>
  </footer>
";
        
        $__internal_2dce80883de4399d72c79a81130fb016ae005967422a7d4c414aab48a05d81e1->leave($__internal_2dce80883de4399d72c79a81130fb016ae005967422a7d4c414aab48a05d81e1_prof);

    }

    public function getTemplateName()
    {
        return "SSAppBundle:Index:index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 6,  40 => 4,  34 => 3,  11 => 1,);
    }
}
