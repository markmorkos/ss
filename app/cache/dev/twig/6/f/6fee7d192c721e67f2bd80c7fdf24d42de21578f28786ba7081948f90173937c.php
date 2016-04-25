<?php

/* WerkintWebappBundle:Templates:head.twig */
class __TwigTemplate_6fee7d192c721e67f2bd80c7fdf24d42de21578f28786ba7081948f90173937c extends Werkint\Bundle\WebappBundle\Twig\Extension\Template
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
        $__internal_dd2c1cfd1cc2b469e5da4b82195df23ef0c93aa9232013eb85bcbfd5ff658e15 = $this->env->getExtension("native_profiler");
        $__internal_dd2c1cfd1cc2b469e5da4b82195df23ef0c93aa9232013eb85bcbfd5ff658e15->enter($__internal_dd2c1cfd1cc2b469e5da4b82195df23ef0c93aa9232013eb85bcbfd5ff658e15_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "WerkintWebappBundle:Templates:head.twig"));

        // line 1
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")));
        foreach ($context['_seq'] as $context["class"] => $context["block"]) {
            // line 2
            echo "  <link href=\"";
            echo twig_escape_filter($this->env, (isset($context["respath"]) ? $context["respath"] : $this->getContext($context, "respath")), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "css", array()), "html", null, true);
            echo ".css\" data-hash=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "css", array()), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\" class=\"";
            echo twig_escape_filter($this->env, (isset($context["prefix"]) ? $context["prefix"] : $this->getContext($context, "prefix")), "html", null, true);
            echo twig_escape_filter($this->env, $context["class"], "html", null, true);
            echo "\"/>
  <script src=\"";
            // line 3
            echo twig_escape_filter($this->env, (isset($context["respath"]) ? $context["respath"] : $this->getContext($context, "respath")), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "js", array()), "html", null, true);
            echo ".js\" data-webapp-hash=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "js", array()), "html", null, true);
            echo "\" data-webapp-cls=\"";
            echo twig_escape_filter($this->env, (isset($context["prefix"]) ? $context["prefix"] : $this->getContext($context, "prefix")), "html", null, true);
            echo twig_escape_filter($this->env, $context["class"], "html", null, true);
            echo "\" class=\"webapp-script\" async></script>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['class'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_dd2c1cfd1cc2b469e5da4b82195df23ef0c93aa9232013eb85bcbfd5ff658e15->leave($__internal_dd2c1cfd1cc2b469e5da4b82195df23ef0c93aa9232013eb85bcbfd5ff658e15_prof);

    }

    public function getTemplateName()
    {
        return "WerkintWebappBundle:Templates:head.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 3,  26 => 2,  22 => 1,);
    }
}
