<?php

namespace App\Livewire;

use App\Events\QuestionCreated;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;


class Question extends Component
{
    public $model;

    public $message;
    public $quantity = 3;

    public $question_edit = [
        'id' => null,
        'body' => null
    ];

    public function mount($model)
    {
        $this->model = $model;
        $this->questions;

    }

    #[Computed()]
    public function questions()
    {
        return $this->model
                    ->questions()
                    ->orderBy('created_at', 'desc')
                    ->take($this->quantity)
                    ->get();
    }

    #[On('createMessage')]
    public function createMessage($nuevoValor)
    {
        $this->message = $nuevoValor;
    }

    #[On('updatedValor')]
    public function updatedValor($nuevoValor)
    {
        $this->question_edit['body'] = $nuevoValor;
    }

    public function store()
    {
        
        $this->validate([
            'message' => 'required|min:10'
        ]);
        
        $question = $this->model->questions()->create([
            'body' => $this->message,
            'user_id' => Auth::user()->id
        ]);

        $this->message = '';
        
        //Event
        QuestionCreated::dispatch($question);

        //este evento esta en el js
        $this->dispatch('clean-editor');

        //borramos cache para nuevo registro
        unset($this->questions);

    }


    public function edit($id)
    {
        $question = $this->model->questions()->find($id);
        
        $this->question_edit = [
            'id' => $question->id,
            'body' => $question->body
        ];
        
    }

    public function destroy($id)
    {
        $question = $this->model->questions()->find($id);
        $question->delete();

        $this->reset('question_edit');
        unset($this->questions);
    }

    public function update()
    {
        $this->validate([
            'question_edit.body' => 'required'
        ]);
        
        $question = $this->model->questions()->find($this->question_edit['id']);

        $question->update([
            'body' => $this->question_edit['body']
        ]);
       
        $this->reset('question_edit');
        unset($this->questions);
    }

    public function cancel()
    {
        $this->reset('question_edit');
    }

    public function showMoreQuestion()
    {
        $this->quantity += 3;
        unset($this->questions);
        $this->dispatch('refresh');
        $this->dispatch('show-prism');
    }




    public function render()
    {
        return view('livewire.question');
    }
}
