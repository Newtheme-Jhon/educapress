<?php

namespace App\Livewire;

use App\Events\AnswerCreated;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Answer extends Component
{
    
    public $question;
    public $model;

    public $answer_created = [
        'open'=> false,
        'body'=> null
    ];

    public $answer_edit = [
        'id' => null,
        'body'=> null,
    ];

    public $answer_to_answer = [
        'id' => null,
        'body'=> null,
    ];

    public $open = false;

    public function mount()
    {
        $this->answers;
    }

    #[Computed()]
    public function answers()
    {
        return $this->question
                    ->answers()
                    ->when(!$this->open, function($query){
                        $query->take(0);
                    })
                    ->get();
    }

    #[On('createAnswerMessage')]
    public function createAnswerMessage($nuevoValor)
    {
        $this->answer_created['body'] = $nuevoValor;
    }

    #[On('answer-to-answer')]
    public function answerToAnswer($valor)
    {
        $this->answer_to_answer['body'] = $valor;
    }

    #[On('updatedValor')]
    public function updatedValor($nuevoValor)
    {
        $this->answer_edit['body'] = $nuevoValor;
    }

    public function showAnswer()
    {
        //dd(1);
        $this->open = !$this->open;
        $this->dispatch('refresh');
        $this->dispatch('show-prism-answer');
    }

    public function store()
    {
        $this->dispatch('initckEditorAnswers');
        $this->validate([
            'answer_created.body' => 'required'
        ]);

        $answer = $this->question->answers()->create([
            'body' => $this->answer_created['body'],
            'user_id' => Auth::user()->id
        ]);

        $this->reset('answer_created');

        //dd($answer->question->questionable_type);

        //event to email
        AnswerCreated::dispatch($answer);

        //unset para borrar el cache y se actualice la consulta
        unset($this->answers);
    }

    public function edit($id)
    {
        $answer = $this->question->answers()->find($id);
        $this->answer_edit = [
            'id' => $answer->id,
            'open'=> true,
            'body'=> $answer->body,
        ];
    }

    public function update()
    {
        $this->validate([
            'answer_edit.body' => 'required'
        ]);

        $this->question->answers()->find($this->answer_edit['id'])->update([
            'body' => $this->answer_edit['body']
        ]);

        $this->reset('answer_edit');
        unset($this->answers);
    }

    public function destroy($id)
    {
        $this->question->answers()->find($id)->delete();
        unset($this->answers);
    }

    public function cancel()
    {
        $this->reset('answer_edit');
    }

    public function answer_to_answer_store()
    {
        //dd($this->answer_to_answer['body']);
        $this->validate([
            'answer_to_answer.body' => 'required'
        ]);

        $answer = $this->question->answers()->create([
            'body' => $this->answer_to_answer['body'],
            'user_id' => Auth::user()->id,
        ]);

        $this->reset('answer_to_answer');
        unset($this->answers);
    }

    public function render()
    {
        return view('livewire.answer');
    }
}
