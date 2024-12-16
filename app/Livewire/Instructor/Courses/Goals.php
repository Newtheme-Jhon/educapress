<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Goal;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Goals extends Component
{
    public $course;
    public $goals;

    #[Validate('required|string|max:255')]
    public $name;

    public function mount()
    {
        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();
    }

    public function store()
    {
        $this->validate();

        // Create a new goal
        $this->course->goals()->create([
            'name' => $this->name
        ]);

        /**
         * Con esto al hacer click en guardar meta se mostrara
         * La meta que acabamos de crear
         */
        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();
        $this->reset('name');
    }

    public function update()
    {
        $this->validate([
            'goals.*.name' => 'required|string|max:255'
        ]);

        // Update the goal
        foreach ($this->goals as $goal) {
            Goal::find($goal['id'])->update([
                'name' => $goal['name']
            ]);
        }

        $this->dispatch('swal', [
            "title"     => "¡Buen trabajo!",
            "text"      => "Las metas se han actualizado correctamente",
            "icon"      => "success"
        ]);
    }

    public function destroy($id)
    {
        //dd($id);
        Goal::find($id)->delete();
        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();
    }

    /**
     * Con este metodo podemos ordenar las metas
     * @param $order
     * en cada iteracion o vuelta del bucle se actualiza el campo order de la meta
     * por ejemplo si tenemos 3 metas, la primera tendra order 1, la segunda 2 y la tercera 3
     */
    public function sortOrderGoals($order){

        foreach ($order as $index => $goal) {
            //dd(Goal::find($goal));
            Goal::find($goal)->update(['order' => $index + 1]);
        }

        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('order', 'asc')
        ->get()->toArray();
    }

    public function render()
    {
        return view('livewire.instructor.courses.goals');
    }
}
