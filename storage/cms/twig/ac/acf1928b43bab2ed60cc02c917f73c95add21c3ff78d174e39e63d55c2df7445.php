<?php

/* /Users/DG/Documents/Etc/NCC/project-website/themes/ncc-basic/pages/home.htm */
class __TwigTemplate_d7d52b14f11360507c7a14e21a78b420845878dde5c45938854f5f9012fa8a85 extends Twig_Template
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
        // line 1
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("resourcesList"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
    }

    public function getTemplateName()
    {
        return "/Users/DG/Documents/Etc/NCC/project-website/themes/ncc-basic/pages/home.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% component 'resourcesList' %}", "/Users/DG/Documents/Etc/NCC/project-website/themes/ncc-basic/pages/home.htm", "");
    }
}
