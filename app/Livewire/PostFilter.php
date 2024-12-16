<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;
use App\Enums\PostStatus;
use Livewire\WithPagination;

class PostFilter extends Component
{
    use WithPagination;

    public $categories;
    public $selectedCategory;

    public $search;

    /**
     * Actualiza la página cada vez que se selecciona un filtro
     * updated seguido del nombre de la propiedad a observar, con esto podremos 
     * realizar la busqueda de un curso que esta en la pagina uno desde la pagina cuatro
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }


    public function mount()
    {
        $this->categories = \App\Models\PostCategory::all();
    }
    

    public function render()
    {
        $posts = Post::where('status', PostStatus::PUBLICADO)
        ->when($this->selectedCategory, function (Builder $query) {
            //dd($this->selectedCategory);
            $query->whereHas('category', function (Builder $query) {
                $query->where('id', $this->selectedCategory);
            });
        })
        ->when($this->search, function (Builder $query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(6);

        
        return view('livewire.post-filter', compact('posts'));
    }
}
