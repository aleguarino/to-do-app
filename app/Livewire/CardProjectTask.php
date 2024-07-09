<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class CardProjectTask extends Component
{
    public $task;
    public $project;

    #[On('refreshData')]
    public function refresh()
    {
        return redirect()->route('showProyect', $this->project->id);
    }

    public function render()
    {
        return view('livewire.card-project-task');
    }

    public function completeTask()
    {
        $this->task->markAsCompleted();
    }

    public function deleteTask()
    {
        $this->task->delete();
        redirect()->route('showProyect', ['id'  => $this->task->project_id])->with('ok', 'Tarea borrada con éxito');
    }
}
