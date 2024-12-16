<?php

namespace App\Livewire;

use App\Enums\CourseStatus;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseFilter extends Component
{
    use WithPagination;

    public $categories;
    public $levels;

    public $selectedCategories = [];
    public $selectedLevels = [];
    public $selectedPrices = [];

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

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatedSelectedLevels()
    {
        $this->resetPage();
    }

    public function updatedSelectedPrices(){
        $this->resetPage();
    }

    public function mount()
    {
        $this->categories = \App\Models\Category::all();
        $this->levels = \App\Models\Level::all();
    }

    public function render()
    {
        $courses = Course::where('status', CourseStatus::PUBLICADO)
        ->when($this->selectedCategories, function ($query) {
            //dd($this->selectedCategories);
            $query->whereHas('category', function ($query) {
                $query->where('category_id', $this->selectedCategories);
            })
            ->orderBy('created_at', 'desc');
            
        })
        ->when($this->selectedLevels, function ($query) {
            $query->whereIn('level_id', $this->selectedLevels);
        })
        ->when($this->selectedPrices, function ($query) {

            if(count($this->selectedPrices) == 1) {
                if($this->selectedPrices[0] == 'free') {
                    $query->where('price_id', '1');
                } else {
                    $query->where('price_id', '!=', 1);
                }
            }

        })
        ->when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })

        ->paginate(6);

        return view('livewire.course-filter', compact('courses'));
    }
}
