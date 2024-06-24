<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\TaskController;
use App\Models\Task;

class UserTasks extends Component
{
    protected $listeners = ['refreshData'];

    public $tasks;
    public $isAllClicked = false;
    public $isActiveClicked = false;
    public $isCompletedClicked = false;
    public $isCanceledClicked = false;
    public $isOverdueClicked = false;



    public function showAll()
    {
        $this->tasks = TaskController::listTaks();
        $this->isAllClicked = true;
        $this->isActiveClicked = $this->isCompletedClicked = $this->isCanceledClicked = $this->isOverdueClicked = false;
    }

    public function showActives()
    {
        $this->tasks = TaskController::listPendingTasks();
        $this->isActiveClicked = true;
        $this->isAllClicked = $this->isCompletedClicked = $this->isCanceledClicked = $this->isOverdueClicked = false;
    }

    public function showCompleted()
    {
        $this->tasks = TaskController::listCompletedTasks();
        $this->isCompletedClicked = true;
        $this->isAllClicked = $this->isActiveClicked = $this->isCanceledClicked = $this->isOverdueClicked = false;
    }

    public function showCanceled()
    {
        $this->tasks = TaskController::listCanceledTasks();
        $this->isCanceledClicked = true;
        $this->isAllClicked = $this->isActiveClicked = $this->isCompletedClicked = $this->isOverdueClicked = false;
    }
    public function showOverdues()
    {
        $this->tasks = TaskController::listOverduesTasks();
        $this->isOverdueClicked = true;
        $this->isAllClicked = $this->isActiveClicked = $this->isCompletedClicked = $this->isCanceledClicked = false;
    }

    public function mount()
    {
        $this->showAll();
    }

    public function render()
    {
        return view('livewire.user-tasks');
    }

    public function refreshData()
    {
        $this->render();
    }
}
