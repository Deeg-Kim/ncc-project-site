<?php

/* /Users/DG/Documents/Etc/NCC/project-website/themes/ncc-basic/pages/view-resource.htm */
class __TwigTemplate_9264b29eecce2287f511d132d8d39aec014b95905ea21e9ea8b3669ff77aeb31 extends Twig_Template
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
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("resourceView"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
    }

    public function getTemplateName()
    {
        return "/Users/DG/Documents/Etc/NCC/project-website/themes/ncc-basic/pages/view-resource.htm";
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
        return new Twig_Source("{% component 'resourceView' %}", "/Users/DG/Documents/Etc/NCC/project-website/themes/ncc-basic/pages/view-resource.htm", "");
    }
}
