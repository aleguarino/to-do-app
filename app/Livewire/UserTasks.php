<?php

namespace App\Livewire;

use Throwable;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;

class UserTasks extends Component
{
    // LISTADO TAREAS
    public $tasks;
    // USUARIO
    public $user;

    // VARIABLES DISEÑO
    public $isAllClicked = true;
    public $isActiveClicked = false;
    public $isCompletedClicked = false;
    public $isCanceledClicked = false;
    public $isOverdueClicked = false;


    public function showAllTasks()
    {
        $this->tasks = $this->user->tasks()->get();
        $this->isAllClicked = true;
        $this->isActiveClicked = $this->isCompletedClicked = $this->isCanceledClicked = $this->isOverdueClicked = false;
    }

    public function showActivesTasks()
    {
        $this->tasks = $this->user->tasks()->where('status', 'Pendiente')->get();
        $this->isActiveClicked = true;
        $this->isAllClicked = $this->isCompletedClicked = $this->isCanceledClicked = $this->isOverdueClicked = false;
    }

    public function showCompletedTasks()
    {
        $this->tasks = $this->user->tasks()->where('status', 'Completada')->get();
        $this->isCompletedClicked = true;
        $this->isAllClicked = $this->isActiveClicked = $this->isCanceledClicked = $this->isOverdueClicked = false;
    }

    public function showCanceledTasks()
    {
        $this->tasks = $this->user->tasks()->where('status', 'Cancelada')->get();
        $this->isCanceledClicked = true;
        $this->isAllClicked = $this->isActiveClicked = $this->isCompletedClicked = $this->isOverdueClicked = false;
    }
    public function showOverduesTasks()
    {
        $this->tasks = $this->user->tasks()->where('status', 'Vencida')->get();
        $this->isOverdueClicked = true;
        $this->isAllClicked = $this->isActiveClicked = $this->isCompletedClicked = $this->isCanceledClicked = false;
    }

    public function mount()
    {
        $this->user = User::find(Auth::id());
        $this->showAllTasks();
    }

    // LISTENER QUE SE LANZA CUANDO SE EDITA UNA TAREA
    #[On('refreshData')]
    public function refresh()
    {
        return redirect()->route('/')->with('ok', 'Tarea actualizada');
    }

    public function render()
    {
        return view('livewire.user-tasks');
    }
}
