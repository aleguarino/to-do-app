<?php

namespace App\Livewire;

use Throwable;
use App\Models\Task;
use Livewire\Component;

class EditProjectTask extends Component
{
    public $task;
    public $id = '';
    public $title = '';
    public $description = '';
    public $deadline = '';
    public $status = '';
    public $priority = '';

    protected $rules = [
        'deadline' => 'required|date|after:today',
    ];

    protected $messages = [
        'deadline.after' => 'La fecha de vencimiento debe ser mayor a la fecha actual',
    ];

    public function mount($task)
    {
        $this->task = $task;
        $this->id = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->deadline = $task->deadline;
        $this->status = $task->status;
        $this->priority = $task->priority;
    }


    public function updateTask()
    {
        try {
            $this->validate();
        } catch (Throwable $e) {
            $this->dispatch('validationError');
            throw $e;
        }

        $task = Task::find($this->id);
        $task->title = $this->title;
        $task->description = $this->description;
        $task->status = $this->status;
        $task->deadline = $this->deadline;
        $task->priority = $this->priority;
        $task->save();
        $this->dispatch('refreshData');
    }
    public function render()
    {
        return view('livewire.edit-project-task');
    }
}
