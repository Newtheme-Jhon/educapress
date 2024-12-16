<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Lesson;
use App\Models\Section;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageSections extends Component
{

    public $course;
    public $name;

    public $sections;

    public $sectionEdit = [
        'id' => null,
        'name' => null
    ];

    public $sectionPositionCreate = [];
    public $orderLessons;

    public function mount()
    {
        $this->getSections();
    }

    #[On('refreshOrderLessons')]
    public function getSections()
    {
        $this->sections = Section::where('course_id', $this->course->id)
            ->with(['lessons' => function($query){
                $query->orderBy('order', 'asc');
            }])
            ->orderBy('order', 'asc')
            ->get();

        $this->orderLessons = $this->sections->pluck('lessons')
            ->collapse()
            ->pluck('id');
    }

    // store section
    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $this->course->sections()->create([
            'name' => $this->name
        ]);
        
        $this->reset('name');
        $this->getSections();
    }

    public function storePosition($sectionId)
    {
        $this->validate([
            'sectionPositionCreate.' . $sectionId . '.name' => 'required'
        ]);

        $order = Section::find($sectionId)->order;
        Section::where('course_id', $this->course->id)
            ->where('order', '>=', $order)
            ->increment('order');

        //dd($this->sectionPositionCreate);
        
        //Al cambiar el order debemos modificar el observer SectionObserver
        //debemos indicar al observer que se ejecute en caso de que no haya nada en el  campo order
        $this->course->sections()->create([
            'name' => $this->sectionPositionCreate[$sectionId]['name'],
            'order' => $order
        ]);

        $this->getSections();
        $this->reset("sectionPositionCreate");
        $this->dispatch('close-section-position-create');
    }

    // edit section (name

    public function edit(Section $section)
    {
        // dd($section);
        $this->sectionEdit = [
            'id' => $section->id,
            'name' => $section->name
        ];
    }

    public function update()
    {
        $this->validate([
            'sectionEdit.name' => 'required'
        ]);

        $section = Section::find($this->sectionEdit['id']);
        $section->update([
            'name' => $this->sectionEdit['name']
        ]);

        $this->reset('sectionEdit');
        $this->getSections();
    }

    public function destroy(Section $section)
    {
        //dd($section);
        $section->delete();
        $this->getSections();
    }

    public function sortSections($sorts)
    {
        foreach($sorts as $order => $sectionId)
        {
            Section::find($sectionId)->update(['order' => $order + 1]);
        }

        $this->getSections();
    }

    #[On('sortLessons')]
    public function sortLessons($sorts, $sectionId)
    {
        //dd($sectionId);
        foreach($sorts as $order => $lessonId)
        {
            Lesson::find($lessonId)->update([
                'order' => $order + 1,
                'section_id' => $sectionId
            ]);
        }

        $this->getSections();
        //$this->dispatch('refreshOrderLessons');
    }

    public function render()
    {
        return view('livewire.instructor.courses.manage-sections');
    }
}
