<?php

/* ::/global/js-globals.twig */
class __TwigTemplate_4b1ebf59fcfee9edd9b7a82ec08711f2553e0639445a6906df9037d0f442807a extends Werkint\Bundle\WebappBundle\Twig\Extension\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c8804a293d47149e0228b53b4d5c39262578eb3ea51ff3c61676a046e837b97a = $this->env->getExtension("native_profiler");
        $__internal_c8804a293d47149e0228b53b4d5c39262578eb3ea51ff3c61676a046e837b97a->enter($__internal_c8804a293d47149e0228b53b4d5c39262578eb3ea51ff3c61676a046e837b97a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::/global/js-globals.twig"));

        // line 1
        echo "<script>";
        // line 2
        echo "  window.\$debug = ";
        echo (($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "debug", array())) ? ("true") : ("false"));
        echo ";
  window.\$assets_version = '";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["assets_version"]) ? $context["assets_version"] : $this->getContext($context, "assets_version")), "html", null, true);
        echo "';
</script>";
        
        $__internal_c8804a293d47149e0228b53b4d5c39262578eb3ea51ff3c61676a046e837b97a->leave($__internal_c8804a293d47149e0228b53b4d5c39262578eb3ea51ff3c61676a046e837b97a_prof);

    }

    public function getTemplateName()
    {
        return "::/global/js-globals.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 3,  24 => 2,  22 => 1,);
    }
}
