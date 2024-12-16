<?php 

namespace App\Traits;

//seotools
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

trait SeoPageTrait
{
    public $modelName;
    public $model;
    public $routeName;
    public $pageName;
    public $pageDescription;
    public $title;
    public $description;

    public function generateShowSeoPage($modelName, $model)
    {
        $this->modelName = $modelName;
        $this->model = $model;

        if($this->modelName == 'post') {
            $this->routeName = route('posts.show', $this->model);
            $this->title = $this->model->title;
            $this->description = $this->model->excerpt;
        }

        if($this->modelName == 'category') {
            $this->routeName = route('categories.show', $this->model);
            $this->title = $this->model->name;
            if($this->model->description) {
                $this->description = $this->model->description;
            } else {
                $this->description = 'Busca los cursos que se adapten a tus nececidades. Entre las categorias encontraras subcategorias, las cuales ayudan a filtrar mucho mejor lo que estas buscando.';
            }
        }

        if($this->modelName == 'course') {
            $this->routeName = route('courses.show', $this->model);
            $this->title = $this->model->title;
            $this->description = $this->model->description;
        }

        SEOMeta::setTitle($this->title);
        SEOMeta::setDescription($this->description);
        SEOMeta::setCanonical($this->routeName);

        OpenGraph::setDescription($this->description);
        OpenGraph::setTitle($this->title);
        OpenGraph::setUrl($this->routeName);
        OpenGraph::addProperty('type', 'article');
    }

    public function generateIndexSeoPage($modelName)
    {
        $this->modelName = $modelName;

        if($this->modelName == 'post') {
            $this->routeName = route('posts.index');
            $this->pageName = config('pages.blog.name');
            $this->pageDescription = config('pages.blog.description');
        }

        if($this->modelName == 'welcome') {
            $this->routeName = route('welcome');
            $this->pageName = config('pages.welcome.name');
            $this->pageDescription = config('pages.welcome.description');
        }

        if($this->modelName == 'info-instructor') {
            $this->routeName = route('pages.instructor');
            $this->pageName = config('pages.info-instructor.name');
            $this->pageDescription = config('pages.info-instructor.description');
        }

        if($this->modelName == 'form-instructor') {
            $this->routeName = route('pages.formInstructor');
            $this->pageName = config('pages.form-instructor.name');
            $this->pageDescription = config('pages.form-instructor.description');
        }

        if($this->modelName == 'politica-privacidad') {
            $this->routeName = route('pages.privacidad');
            $this->pageName = config('pages.politica-privacidad.name');
            $this->pageDescription = config('pages.politica-privacidad.description');
        }

        if($this->modelName == 'condiciones') {
            $this->routeName = route('pages.condiciones');
            $this->pageName = config('pages.condiciones.name');
            $this->pageDescription = config('pages.condiciones.description');
        }

        if($this->modelName == 'politica-cookies') {
            $this->routeName = route('pages.cookies');
            $this->pageName = config('pages.politica-cookies.name');
            $this->pageDescription = config('pages.politica-cookies.description');
        }

        if($this->modelName == 'courses') {
            $this->routeName = route('courses.index');
            $this->pageName = config('pages.courses.name');
            $this->pageDescription = config('pages.courses.description');
        }


        SEOMeta::setTitle($this->pageName);
        SEOMeta::setDescription($this->pageDescription);
        SEOMeta::setCanonical($this->routeName);

        OpenGraph::setDescription($this->pageDescription);
        OpenGraph::setTitle($this->pageName);
        OpenGraph::setUrl($this->routeName);
        OpenGraph::addProperty('type', 'articles');
    }
}