<?php

/* /Users/DG/Documents/Etc/NCC/project-website/plugins/dgkim/digitalresourcesdb/components/resourceview/default.htm */
class __TwigTemplate_a99a8c68890f15b5aee8b79c6187a4c70314f37e6439834ab5a895183870c9c7 extends Twig_Template
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
\t\t<div style=\"width: 100%; height: 15px\"></div>
\t\t<a href=\"";
        // line 4
        echo url("/");
        echo "\">Back to all resources</a>
\t\t<div class=\"card\" style=\"width: 100%; margin: 10px 0 10px 0\">
\t\t\t<div class=\"card-body\">
\t\t\t\t<h3 class=\"card-title\">";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["resource"] ?? null), "name_japanese", array()), "html", null, true);
        echo "</h3>
\t\t\t\t<h5 class=\"card-subtitle mb-2 text-muted\">";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["resource"] ?? null), "name_english", array()), "html", null, true);
        echo "</h5>
\t\t\t\t";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->getSourceContext(), ($context["resource"] ?? null), "categories", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 10
            echo "\t\t\t\t<span class=\"badge badge-primary\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["category"], "name_english", array()), "html", null, true);
            echo "</span>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "\t\t\t\t<p>
\t\t\t\t\t<a href=\"#\" class=\"card-link\">";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["resource"] ?? null), "link", array()), "html", null, true);
        echo "</a>
\t\t\t\t</p>
\t\t\t\t<p class=\"card-text\">";
        // line 15
        echo twig_get_attribute($this->env, $this->getSourceContext(), ($context["resource"] ?? null), "description", array());
        echo "</p>
\t\t\t\t<p class=\"card-text\"><b>Keywords:</b> ";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["resource"] ?? null), "keywords", array()), "html", null, true);
        echo "</p>
\t\t  \t</div>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "/Users/DG/Documents/Etc/NCC/project-website/plugins/dgkim/digitalresourcesdb/components/resourceview/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 16,  59 => 15,  54 => 13,  51 => 12,  42 => 10,  38 => 9,  34 => 8,  30 => 7,  24 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row\">
\t<div class=\"col-md-8 offset-md-2\">
\t\t<div style=\"width: 100%; height: 15px\"></div>
\t\t<a href=\"{{ url('/' )}}\">Back to all resources</a>
\t\t<div class=\"card\" style=\"width: 100%; margin: 10px 0 10px 0\">
\t\t\t<div class=\"card-body\">
\t\t\t\t<h3 class=\"card-title\">{{ resource.name_japanese }}</h3>
\t\t\t\t<h5 class=\"card-subtitle mb-2 text-muted\">{{ resource.name_english }}</h5>
\t\t\t\t{% for category in resource.categories %}
\t\t\t\t<span class=\"badge badge-primary\">{{ category.name_english }}</span>
\t\t\t\t{% endfor %}
\t\t\t\t<p>
\t\t\t\t\t<a href=\"#\" class=\"card-link\">{{ resource.link }}</a>
\t\t\t\t</p>
\t\t\t\t<p class=\"card-text\">{{ resource.description|raw }}</p>
\t\t\t\t<p class=\"card-text\"><b>Keywords:</b> {{ resource.keywords }}</p>
\t\t  \t</div>
\t\t</div>
\t</div>
</div>", "/Users/DG/Documents/Etc/NCC/project-website/plugins/dgkim/digitalresourcesdb/components/resourceview/default.htm", "");
    }
}
