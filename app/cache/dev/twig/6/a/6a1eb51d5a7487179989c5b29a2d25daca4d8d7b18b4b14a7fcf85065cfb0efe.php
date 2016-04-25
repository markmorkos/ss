<?php

/* TwigBundle:Exception:exception.json.twig */
class __TwigTemplate_6a1eb51d5a7487179989c5b29a2d25daca4d8d7b18b4b14a7fcf85065cfb0efe extends Werkint\Bundle\WebappBundle\Twig\Extension\Template
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
        $__internal_2d4a19c6c46c97b90732dade738ea3be7809387db14b528af1f2c160e342d634 = $this->env->getExtension("native_profiler");
        $__internal_2d4a19c6c46c97b90732dade738ea3be7809387db14b528af1f2c160e342d634->enter($__internal_2d4a19c6c46c97b90732dade738ea3be7809387db14b528af1f2c160e342d634_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.json.twig"));

        // line 1
        echo twig_jsonencode_filter(array("error" => array("code" => (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "message" => (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "exception" => $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "toarray", array()))));
        echo "
";
        
        $__internal_2d4a19c6c46c97b90732dade738ea3be7809387db14b528af1f2c160e342d634->leave($__internal_2d4a19c6c46c97b90732dade738ea3be7809387db14b528af1f2c160e342d634_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.json.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
