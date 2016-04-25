<?php

/* @SSApp/layout.twig */
class __TwigTemplate_0a2c874882a3ad7e9ff2b2f5c7f72589ca9b59d393fdb115df8b23e8f68bd896 extends Werkint\Bundle\WebappBundle\Twig\Extension\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.twig", "@SSApp/layout.twig", 1);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c88b56c9fad38bc324f8f103d42eff9cf0aff9fe5d2b636dba070b5164b267d7 = $this->env->getExtension("native_profiler");
        $__internal_c88b56c9fad38bc324f8f103d42eff9cf0aff9fe5d2b636dba070b5164b267d7->enter($__internal_c88b56c9fad38bc324f8f103d42eff9cf0aff9fe5d2b636dba070b5164b267d7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@SSApp/layout.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c88b56c9fad38bc324f8f103d42eff9cf0aff9fe5d2b636dba070b5164b267d7->leave($__internal_c88b56c9fad38bc324f8f103d42eff9cf0aff9fe5d2b636dba070b5164b267d7_prof);

    }

    public function getTemplateName()
    {
        return "@SSApp/layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  11 => 1,);
    }
}
