<?php

/* layout.twig */
class __TwigTemplate_40b8944a1caeaf4d36e787b5763c6ddcc23c603fd863df16e0e02d83bd04ae2f extends Werkint\Bundle\WebappBundle\Twig\Extension\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'html_attributes' => array($this, 'block_html_attributes'),
            'baseHead' => array($this, 'block_baseHead'),
            'basetitle' => array($this, 'block_basetitle'),
            'title' => array($this, 'block_title'),
            'baseScripts' => array($this, 'block_baseScripts'),
            'baseJsGlobals' => array($this, 'block_baseJsGlobals'),
            'global_js' => array($this, 'block_global_js'),
            'baseStyles' => array($this, 'block_baseStyles'),
            'baseMetatags' => array($this, 'block_baseMetatags'),
            'head' => array($this, 'block_head'),
            'basePage' => array($this, 'block_basePage'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_65709493349b01212651da058f7c501907facd521b682649769b677100221023 = $this->env->getExtension("native_profiler");
        $__internal_65709493349b01212651da058f7c501907facd521b682649769b677100221023->enter($__internal_65709493349b01212651da058f7c501907facd521b682649769b677100221023_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "layout.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "locale", array()), "html", null, true);
        echo "\" ";
        $this->displayBlock('html_attributes', $context, $blocks);
        echo ">
<head>
  <link rel=\"icon\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/ssapp/images/fav.ico"), "html", null, true);
        echo "\" type=\"image/x-icon\">
  <link rel=\"shortcut icon\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/ssapp/images/fav.ico"), "html", null, true);
        echo "\" type=\"image/x-icon\">

  ";
        // line 7
        $this->displayBlock('baseHead', $context, $blocks);
        // line 33
        echo "</head>
<body>
<div class=\"wrapper\">
  ";
        // line 36
        ob_start();
        // line 37
        echo "    ";
        $this->displayBlock('basePage', $context, $blocks);
        // line 46
        echo "  ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 47
        echo "</div>
</body>
</html>";
        
        $__internal_65709493349b01212651da058f7c501907facd521b682649769b677100221023->leave($__internal_65709493349b01212651da058f7c501907facd521b682649769b677100221023_prof);

    }

    // line 2
    public function block_html_attributes($context, array $blocks = array())
    {
        $__internal_389e9b6bd5bb56e20ad2d76ded7df6119a9dba9c9df2592544f20b46114b2225 = $this->env->getExtension("native_profiler");
        $__internal_389e9b6bd5bb56e20ad2d76ded7df6119a9dba9c9df2592544f20b46114b2225->enter($__internal_389e9b6bd5bb56e20ad2d76ded7df6119a9dba9c9df2592544f20b46114b2225_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "html_attributes"));

        echo "class=\"no-js\"";
        
        $__internal_389e9b6bd5bb56e20ad2d76ded7df6119a9dba9c9df2592544f20b46114b2225->leave($__internal_389e9b6bd5bb56e20ad2d76ded7df6119a9dba9c9df2592544f20b46114b2225_prof);

    }

    // line 7
    public function block_baseHead($context, array $blocks = array())
    {
        $__internal_3a290613600556281d7dab0a5ef4cfaf17910e2e605a7879578f12b2c3ab77e4 = $this->env->getExtension("native_profiler");
        $__internal_3a290613600556281d7dab0a5ef4cfaf17910e2e605a7879578f12b2c3ab77e4->enter($__internal_3a290613600556281d7dab0a5ef4cfaf17910e2e605a7879578f12b2c3ab77e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "baseHead"));

        // line 8
        echo "    <title>";
        $this->displayBlock('basetitle', $context, $blocks);
        if ($this->renderBlock("title", $context, $blocks)) {
            echo " | ";
        }
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
  ";
        // line 9
        $this->displayBlock('baseScripts', $context, $blocks);
        // line 20
        echo "
  ";
        // line 21
        $this->displayBlock('baseStyles', $context, $blocks);
        // line 24
        echo "
  ";
        // line 25
        $this->displayBlock('baseMetatags', $context, $blocks);
        // line 29
        echo "
    ";
        // line 30
        echo call_user_func_array($this->env->getFunction('webapp_head_init')->getCallable(), array());
        echo "
    ";
        // line 31
        $this->displayBlock('head', $context, $blocks);
        // line 32
        echo "  ";
        
        $__internal_3a290613600556281d7dab0a5ef4cfaf17910e2e605a7879578f12b2c3ab77e4->leave($__internal_3a290613600556281d7dab0a5ef4cfaf17910e2e605a7879578f12b2c3ab77e4_prof);

    }

    // line 8
    public function block_basetitle($context, array $blocks = array())
    {
        $__internal_8288cd4e2e1608c8cf14d1453391cf1fe3de5629ea527a35a3eb63f193aaa6c6 = $this->env->getExtension("native_profiler");
        $__internal_8288cd4e2e1608c8cf14d1453391cf1fe3de5629ea527a35a3eb63f193aaa6c6->enter($__internal_8288cd4e2e1608c8cf14d1453391cf1fe3de5629ea527a35a3eb63f193aaa6c6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "basetitle"));

        echo "SECURITY SCIENCE";
        
        $__internal_8288cd4e2e1608c8cf14d1453391cf1fe3de5629ea527a35a3eb63f193aaa6c6->leave($__internal_8288cd4e2e1608c8cf14d1453391cf1fe3de5629ea527a35a3eb63f193aaa6c6_prof);

    }

    public function block_title($context, array $blocks = array())
    {
        $__internal_8bab012d72ac7fa20ff0bf7da97f5128a569e76899eb236cf70a59bb452a4574 = $this->env->getExtension("native_profiler");
        $__internal_8bab012d72ac7fa20ff0bf7da97f5128a569e76899eb236cf70a59bb452a4574->enter($__internal_8bab012d72ac7fa20ff0bf7da97f5128a569e76899eb236cf70a59bb452a4574_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_8bab012d72ac7fa20ff0bf7da97f5128a569e76899eb236cf70a59bb452a4574->leave($__internal_8bab012d72ac7fa20ff0bf7da97f5128a569e76899eb236cf70a59bb452a4574_prof);

    }

    // line 9
    public function block_baseScripts($context, array $blocks = array())
    {
        $__internal_3bfa09154055767b214467d74e5d3eb849e3458b0a7594ab6968fbfd9a4183e3 = $this->env->getExtension("native_profiler");
        $__internal_3bfa09154055767b214467d74e5d3eb849e3458b0a7594ab6968fbfd9a4183e3->enter($__internal_3bfa09154055767b214467d74e5d3eb849e3458b0a7594ab6968fbfd9a4183e3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "baseScripts"));

        // line 10
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("assets/js/require.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/ssapp/config.js"), "html", null, true);
        echo "\"></script>
    ";
        // line 12
        $this->displayBlock('baseJsGlobals', $context, $blocks);
        // line 15
        echo "
    ";
        // line 16
        $this->displayBlock('global_js', $context, $blocks);
        // line 18
        echo "
  ";
        
        $__internal_3bfa09154055767b214467d74e5d3eb849e3458b0a7594ab6968fbfd9a4183e3->leave($__internal_3bfa09154055767b214467d74e5d3eb849e3458b0a7594ab6968fbfd9a4183e3_prof);

    }

    // line 12
    public function block_baseJsGlobals($context, array $blocks = array())
    {
        $__internal_c2fba55ad5f5cac4edd9afc7cb1135af8339986b3adeb624f0627a626548c6b1 = $this->env->getExtension("native_profiler");
        $__internal_c2fba55ad5f5cac4edd9afc7cb1135af8339986b3adeb624f0627a626548c6b1->enter($__internal_c2fba55ad5f5cac4edd9afc7cb1135af8339986b3adeb624f0627a626548c6b1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "baseJsGlobals"));

        // line 13
        echo "      ";
        $this->loadTemplate("::/global/js-globals.twig", "layout.twig", 13)->display($context);
        // line 14
        echo "    ";
        
        $__internal_c2fba55ad5f5cac4edd9afc7cb1135af8339986b3adeb624f0627a626548c6b1->leave($__internal_c2fba55ad5f5cac4edd9afc7cb1135af8339986b3adeb624f0627a626548c6b1_prof);

    }

    // line 16
    public function block_global_js($context, array $blocks = array())
    {
        $__internal_c14e4583f417bf5ebd6071cee39bc36155f9a99852658becc5844e9fb344b331 = $this->env->getExtension("native_profiler");
        $__internal_c14e4583f417bf5ebd6071cee39bc36155f9a99852658becc5844e9fb344b331->enter($__internal_c14e4583f417bf5ebd6071cee39bc36155f9a99852658becc5844e9fb344b331_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "global_js"));

        // line 17
        echo "    ";
        
        $__internal_c14e4583f417bf5ebd6071cee39bc36155f9a99852658becc5844e9fb344b331->leave($__internal_c14e4583f417bf5ebd6071cee39bc36155f9a99852658becc5844e9fb344b331_prof);

    }

    // line 21
    public function block_baseStyles($context, array $blocks = array())
    {
        $__internal_c7648bb3eadbb420b4023abcf8d4613e665ceb5b2f074c86324ea7771bafaa2c = $this->env->getExtension("native_profiler");
        $__internal_c7648bb3eadbb420b4023abcf8d4613e665ceb5b2f074c86324ea7771bafaa2c->enter($__internal_c7648bb3eadbb420b4023abcf8d4613e665ceb5b2f074c86324ea7771bafaa2c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "baseStyles"));

        // line 22
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("styles.css"), "html", null, true);
        echo "\">
  ";
        
        $__internal_c7648bb3eadbb420b4023abcf8d4613e665ceb5b2f074c86324ea7771bafaa2c->leave($__internal_c7648bb3eadbb420b4023abcf8d4613e665ceb5b2f074c86324ea7771bafaa2c_prof);

    }

    // line 25
    public function block_baseMetatags($context, array $blocks = array())
    {
        $__internal_dc826c3ec2f6ae3372305e954fc12c32185f54f55b11a24598a9c3b098e69932 = $this->env->getExtension("native_profiler");
        $__internal_dc826c3ec2f6ae3372305e954fc12c32185f54f55b11a24598a9c3b098e69932->enter($__internal_dc826c3ec2f6ae3372305e954fc12c32185f54f55b11a24598a9c3b098e69932_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "baseMetatags"));

        // line 26
        echo "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"robots\" content=\"index\">
  ";
        
        $__internal_dc826c3ec2f6ae3372305e954fc12c32185f54f55b11a24598a9c3b098e69932->leave($__internal_dc826c3ec2f6ae3372305e954fc12c32185f54f55b11a24598a9c3b098e69932_prof);

    }

    // line 31
    public function block_head($context, array $blocks = array())
    {
        $__internal_a3f13f85e48ea5654c0fb5a738bd7fc0ad2b847a7b70084d3cc8a1f962b5c525 = $this->env->getExtension("native_profiler");
        $__internal_a3f13f85e48ea5654c0fb5a738bd7fc0ad2b847a7b70084d3cc8a1f962b5c525->enter($__internal_a3f13f85e48ea5654c0fb5a738bd7fc0ad2b847a7b70084d3cc8a1f962b5c525_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        
        $__internal_a3f13f85e48ea5654c0fb5a738bd7fc0ad2b847a7b70084d3cc8a1f962b5c525->leave($__internal_a3f13f85e48ea5654c0fb5a738bd7fc0ad2b847a7b70084d3cc8a1f962b5c525_prof);

    }

    // line 37
    public function block_basePage($context, array $blocks = array())
    {
        $__internal_8644d193eb5100cd2603ab072c90e6348e7b69d183648f574d98301762f9bac6 = $this->env->getExtension("native_profiler");
        $__internal_8644d193eb5100cd2603ab072c90e6348e7b69d183648f574d98301762f9bac6->enter($__internal_8644d193eb5100cd2603ab072c90e6348e7b69d183648f574d98301762f9bac6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "basePage"));

        // line 38
        echo "      <div class=\"templates\" id=\"global_page_templates\" style=\"display: none\">
        ";
        // line 39
        echo $this->env->getExtension('werkint_templating_twigjs')->loadModules();
        // line 40
        echo "      </div>

      ";
        // line 42
        $this->displayBlock('content', $context, $blocks);
        // line 44
        echo "
    ";
        
        $__internal_8644d193eb5100cd2603ab072c90e6348e7b69d183648f574d98301762f9bac6->leave($__internal_8644d193eb5100cd2603ab072c90e6348e7b69d183648f574d98301762f9bac6_prof);

    }

    // line 42
    public function block_content($context, array $blocks = array())
    {
        $__internal_5b8f941ff3b0a46515f422285d86d37f545a88a876dba4e41f8398f93448de4e = $this->env->getExtension("native_profiler");
        $__internal_5b8f941ff3b0a46515f422285d86d37f545a88a876dba4e41f8398f93448de4e->enter($__internal_5b8f941ff3b0a46515f422285d86d37f545a88a876dba4e41f8398f93448de4e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 43
        echo "      ";
        
        $__internal_5b8f941ff3b0a46515f422285d86d37f545a88a876dba4e41f8398f93448de4e->leave($__internal_5b8f941ff3b0a46515f422285d86d37f545a88a876dba4e41f8398f93448de4e_prof);

    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  286 => 43,  280 => 42,  272 => 44,  270 => 42,  266 => 40,  264 => 39,  261 => 38,  255 => 37,  244 => 31,  235 => 26,  229 => 25,  219 => 22,  213 => 21,  206 => 17,  200 => 16,  193 => 14,  190 => 13,  184 => 12,  176 => 18,  174 => 16,  171 => 15,  169 => 12,  165 => 11,  160 => 10,  154 => 9,  132 => 8,  125 => 32,  123 => 31,  119 => 30,  116 => 29,  114 => 25,  111 => 24,  109 => 21,  106 => 20,  104 => 9,  95 => 8,  89 => 7,  77 => 2,  68 => 47,  65 => 46,  62 => 37,  60 => 36,  55 => 33,  53 => 7,  48 => 5,  44 => 4,  37 => 2,  34 => 1,);
    }
}
