<?php

namespace App\Livewire;

use App\Enums\CourseStatus;
use App\Models\Category;
use App\Models\Course;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category;

    public $subcategories;
    public $selectedSubcategories = [];

    public function updatedSelectedSubcategories()
    {
        $this->resetPage();
    }

    public function mount()
    {
        //dd($this->category->id);
        $this->subcategories = Subcategory::where('category_id', $this->category->id)->get();
    }

    public function render()
    {
        // $courses = $category->courses()->paginate(10);
        $courses = Course::where('status', CourseStatus::PUBLICADO)
        ->where('category_id', $this->category->id)
        ->when($this->selectedSubcategories, function ($query) {
            $query->whereHas('subcategories', function ($query) {
                $query->where('subcategory_id', $this->selectedSubcategories);
            });
        })
        
        ->paginate(10);

        return view('livewire.category-filter', compact('courses'));
    }
}
