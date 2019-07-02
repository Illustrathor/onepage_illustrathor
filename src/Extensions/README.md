# Create a new extension

I will demonstrate *step by step* how to create an extension
(Once you know how it works, it will be faster by starting with a `make:crud`)

It is actually very simple. Let's start by creating a new folder called Portoflio in `src/Extensions/Portoflio`

Next step is to create our controller and create a first route 

Create a new Controller  `src/Extensions/Portoflio/Controller/PortraitController`

```php
<?php

namespace App\Extensions\Portfolio\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/extension/portfolio/portrait")
 */
class PortraitController extends AbstractController
{
    /**
     * @Route("/", name="portrait")
     */
    public function index()
    {
        return $this->render('@damnPortfolio/index.html.twig', [
            'controller_name' => 'PortraitController',
            'portraits' => []
        ]);
    }
}

```

We now need to tell Symfony that we have a new path to look for Controllers and also tell him that we possibly have new routes

Create a new service:
(config/services.yaml)
```yaml
services:
    App\Extensions\Portfolio\Controller\:
        resource: '../src/Extensions/Portfolio/Controller'
        tags: ['controller.service_arguments']
```

Add a new controller path that can use annotations: (config/routes/annotations.yaml)
```yaml
portfolio:
    resource: ../../src/Extensions/Portfolio/Controller/
    type: annotation
```

Let's now create a new template for the index() of our controller
`src/Extensions/Portoflio/templates/index.html.twig`

```twig
{% extends 'admin/layout.html.twig' %}

{% block title %}Portrait Index{% endblock %}

{% block body %}
    <h1>Portrait index</h1>
    <div class="table-responsive-md">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Online</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {% for portrait in portraits %}
                <tr>
                    <td>{{ portrait.name }}</td>
                    <td>{{ portrait.description }}</td>
                    <td><img src="{{ asset('uploads/' ~ portrait.image) }}" style="max-height: 70px;width: auto;"></td>
                    <td>{{ portrait.enabled ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ path('portrait_show', {'id': portrait.id}) }}">show</a>
                        <a href="{{ path('portrait_edit', {'id': portrait.id}) }}">edit</a>
                    </td>
                </tr>
            {% else %}
                <tr>
                    <td colspan="13">no records found</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>

    <a href="{{ path('portrait_new') }}">Create new</a>
{% endblock %}
```

You should now be able to browse to `/admin/extension/portfolio/portrait/`

Last step is to add it to the left-menu. To do so, edit the layout file `templates/admin/layout.html.twig`

```twig
. . .

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-folder"></i>
        <span>Portfolio</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <h6 class="dropdown-header">Portraits:</h6>
        <a class="dropdown-item" href="{##}">Create</a>
        <a class="dropdown-item" href="{{ path('portrait_index') }}">Catalogue</a>
    </div>
</li>

. . .
```

![alt text](https://github.com/newQuery/damnWork/blob/master/public/readme/extension.PNG?raw=true)