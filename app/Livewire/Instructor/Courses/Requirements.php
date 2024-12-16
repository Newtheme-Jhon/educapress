<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Requirement;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Requirements extends Component
{

    public $course;
    public $requirements;

    #[Validate('required|string|max:255')]
    public $name;

    public function mount()
    {
        $this->requirements = Requirement::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();
    }

    public function store()
    {
        $this->validate();

        // Create a new goal
        $this->course->requirements()->create([
            'name' => $this->name
        ]);

        /**
         * Con esto al hacer click en guardar meta se mostrara
         * La meta que acabamos de crear
         */
        $this->requirements = Requirement::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();

        $this->reset('name');
    }

    public function update()
    {
        $this->validate([
            'requirements.*.name' => 'required|string|max:255'
        ]);

        // Update the requirements
        foreach ($this->requirements as $requirement) {
            Requirement::find($requirement['id'])->update([
                'name' => $requirement['name']
            ]);
        }

        $this->dispatch('swal', [
            "title"     => "¡Buen trabajo!",
            "text"      => "Los requisitos se han actualizado correctamente",
            "icon"      => "success"
        ]);
    }

    public function destroy($id)
    {
        //dd($id);
        Requirement::find($id)->delete();
        $this->requirements = Requirement::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();
    }

    /**
     * Con este metodo podemos ordenar las metas
     * @param $order
     * en cada iteracion o vuelta del bucle se actualiza el campo order de la meta
     * por ejemplo si tenemos 3 metas, la primera tendra order 1, la segunda 2 y la tercera 3
     */
    public function sortOrderRequirements($order){

        foreach ($order as $index => $requirement) {
            //dd(Goal::find($goal));
            Requirement::find($requirement)->update(['order' => $index + 1]);
        }

        $this->requirements = Requirement::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();
    }

    public function render()
    {
        return view('livewire.instructor.courses.requirements');
    }
}
