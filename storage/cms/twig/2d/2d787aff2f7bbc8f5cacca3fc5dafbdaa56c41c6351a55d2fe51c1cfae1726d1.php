<?php

/* /Users/DG/Documents/Etc/NCC/project-website/plugins/dgkim/digitalresourcesdb/components/resourceslist/default.htm */
class __TwigTemplate_a5d73246d6b075e9226d74abbae119036628796cf682f903a2b6676f124119e2 extends Twig_Template
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
        echo "<div class=\"row\">
\t<div class=\"col-md-8 offset-md-2\">
\t\t";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["resources"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["resource"]) {
            // line 4
            echo "\t\t\t<div class=\"card\" style=\"width: 100%; margin: 10px 0 10px 0\">
\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t<h3 class=\"card-title\"><a href=\"";
            // line 6
            echo url("/resource/");
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["resource"], "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["resource"], "name_japanese", array()), "html", null, true);
            echo "</a></h3>
\t\t\t\t\t<h5 class=\"card-subtitle mb-2 text-muted\">";
            // line 7
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["resource"], "name_english", array()), "html", null, true);
            echo "</h5>
\t\t\t\t\t";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->getSourceContext(), $context["resource"], "categories", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 9
                echo "\t\t\t\t\t<span class=\"badge badge-primary\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["category"], "name_english", array()), "html", null, true);
                echo "</span>
\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 11
            echo "\t\t\t\t\t<p>
\t\t\t\t\t\t<a href=\"#\" class=\"card-link\">";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["resource"], "link", array()), "html", null, true);
            echo "</a>
\t\t\t\t\t</p>
\t\t\t\t\t<p class=\"card-text\">";
            // line 14
            echo twig_get_attribute($this->env, $this->getSourceContext(), $context["resource"], "description", array());
            echo "</p>
\t\t\t  \t</div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['resource'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "\t</div>
</div>

";
        // line 21
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('styles'        );
        // line 22
        echo "<style>
\tspan .btn {
\t\tfont-size: 0.8em;
\t}
\t
\t.card-text {
\t\tfont-size: 0.9em;
\t}
</style>
";
        // line 21
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/Users/DG/Documents/Etc/NCC/project-website/plugins/dgkim/digitalresourcesdb/components/resourceslist/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 21,  81 => 22,  79 => 21,  74 => 18,  64 => 14,  59 => 12,  56 => 11,  47 => 9,  43 => 8,  39 => 7,  31 => 6,  27 => 4,  23 => 3,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row\">
\t<div class=\"col-md-8 offset-md-2\">
\t\t{% for resource in resources %}
\t\t\t<div class=\"card\" style=\"width: 100%; margin: 10px 0 10px 0\">
\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t<h3 class=\"card-title\"><a href=\"{{ url('/resource/') }}/{{ resource.id }}\">{{ resource.name_japanese }}</a></h3>
\t\t\t\t\t<h5 class=\"card-subtitle mb-2 text-muted\">{{ resource.name_english }}</h5>
\t\t\t\t\t{% for category in resource.categories %}
\t\t\t\t\t<span class=\"badge badge-primary\">{{ category.name_english }}</span>
\t\t\t\t\t{% endfor %}
\t\t\t\t\t<p>
\t\t\t\t\t\t<a href=\"#\" class=\"card-link\">{{ resource.link }}</a>
\t\t\t\t\t</p>
\t\t\t\t\t<p class=\"card-text\">{{ resource.description|raw }}</p>
\t\t\t  \t</div>
\t\t\t</div>
\t\t{% endfor %}
\t</div>
</div>

{% put styles %}
<style>
\tspan .btn {
\t\tfont-size: 0.8em;
\t}
\t
\t.card-text {
\t\tfont-size: 0.9em;
\t}
</style>
{% endput %}", "/Users/DG/Documents/Etc/NCC/project-website/plugins/dgkim/digitalresourcesdb/components/resourceslist/default.htm", "");
    }
}
